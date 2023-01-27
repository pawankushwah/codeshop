<?php
require("./connection.inc.php");
// require("./function.inc.php");
function get_safe_valuex($conn, $data)
{
    if ($data != "") {
        $data = trim($data);
        return mysqli_real_escape_string($conn, $data);
    }
}
ob_start();
// error_reporting(0);
/* category operations */
// fetching categories
$sql = "SELECT * FROM $CATEGORY ORDER BY `categories` ASC";
$category_result = mysqli_query($conn, $sql);

// showing the value of clicked category
if (isset($_GET['type']) && $_GET['type'] == 'edit') {
    if (isset($_GET['id']) && $_GET['id'] != '') {
        $id = get_safe_valuex($conn, $_GET['id']);

        $sql = "SELECT * FROM PRODUCT WHERE `id`='$id'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) $row = mysqli_fetch_assoc($result);
    }
}

// setting the default value of form data to none
$categories_name = $name = $image = $mrp = $selling_price = $qty = $short_desc = $description = $meta_title = $meta_short_desc = $meta_desc = $meta_keyword = '';

if (isset($_POST['addProduct'])) {
    // getting data from form
    $categories_name = get_safe_valuex($conn, $_POST['category_name']);
    $name = get_safe_valuex($conn, $_POST['name']);
    $mrp = get_safe_valuex($conn, $_POST['mrp']);
    $selling_price = get_safe_valuex($conn, $_POST['selling_price']);
    $qty = get_safe_valuex($conn, $_POST['qty']);
    // $image = get_safe_valuex($conn, $_FILES['image']['name']);
    $short_desc = get_safe_valuex($conn, $_POST['short_desc']);
    $description = get_safe_valuex($conn, $_POST['description']);
    $meta_title = get_safe_valuex($conn, $_POST['meta_title']);
    $meta_short_desc = get_safe_valuex($conn, $_POST['meta_short_desc']);
    $meta_desc = get_safe_valuex($conn, $_POST['meta_desc']);
    $meta_keyword = get_safe_valuex($conn, $_POST['meta_keyword']);

    // checking the image
    $imagename = 'image';
    $filename = get_safe_valuex($conn, $_FILES[$imagename]['name']);
    $tempfilename = get_safe_valuex($conn, $_FILES[$imagename]['tmp_name']);
    $filesize = get_safe_valuex($conn, $_FILES[$imagename]['size']);
    $folder = "../images/product/";
    $maxFileSize = 2097152;

    // validating image file
    $allowed_image_extension = array(
        "png",
        "jpg",
        "jpeg"
    );
    $file_extension = pathinfo($filename, PATHINFO_EXTENSION);
    // Validate file input to check if is not empty
    if (!file_exists($_FILES[$imagename]['tmp_name'])) {
        $response = array(
            "type" => "error",
            "ImageMessage" => "Choose image file to upload."
        );
    }    // Validate file input to check if it is with valid extension
    else if (!in_array($file_extension, $allowed_image_extension)) {
        $response = array(
            "type" => "error",
            "ImageMessage" => "Upload valid images. Only PNG and JPEG are allowed."
        );
    }    // Validate image file size
    else if (($filesize > $maxFileSize)) {
        $response = array(
            "type" => "error",
            "ImageMessage" => "Image size exceeds 2MB"
        );
    }    // Validate image file dimension
    // else if ($width > "300" || $height > "200") {
    //     $response = array(
    //         "type" => "error",
    //         "ImageMessage" => "Image dimension should be within 300X200"
    //     );
    // } 
    else {
        $uniqFileName = pathinfo($_FILES[$imagename]["name"], PATHINFO_FILENAME) . "-" . uniqid() . "." . pathinfo($_FILES[$imagename]["name"], PATHINFO_EXTENSION);
        $target = $folder . $uniqFileName;
        if (move_uploaded_file($_FILES[$imagename]["tmp_name"], $target)) {
            $response = array(
                "type" => "success",
                "ImageMessage" => "Image uploaded successfully."
            );
        } else {
            $response = array(
                "type" => "error",
                "ImageMessage" => "Problem in uploading image files."
            );
        }
    }

    if ($response['type'] != "error") {
        $existsql = "SELECT * FROM PRODUCT WHERE `name`='$name';";
        $product_name_result = mysqli_query($conn, $existsql);
        $product_name_num = mysqli_num_rows($product_name_result);

        if ($product_name_num > 0) {
            if (isset($_GET['id']) && $_GET['id'] != '') {
                $getData = mysqli_fetch_assoc($product_name_result);
                if ($id == $getData['id']) {
                } else {
                    $response = array(
                        "type" => "error",
                        "message" => "Name Already Exist"
                    );
                }
            }
        }

        if (!isset($response['message'])) {
            // checking whether you came from category page or by url and forming sql accordingly
            if (isset($_GET['id']) && $_GET['id'] != '') {
                $sql = "UPDATE PRODUCT SET `categories_name`='$categories_name', `name`='$name', `mrp`='$mrp', `selling_price`='$selling_price', `qty`='$qty', `image`='$uniqFileName', `meta_title`='$meta_title', `meta_short_desc`='$meta_short_desc', `meta_desc`='$meta_desc', `meta_keyword`='$meta_keyword', `description`='$description', `short_desc`='$short_desc', `status`='1' WHERE `id`='$id'";
            } else {
                $sql = "INSERT INTO PRODUCT (`categories_name`, `name`, `mrp`, `selling_price`, `qty`, `image`, `meta_title`, `meta_short_desc`, `meta_desc`, `meta_keyword`, `description`, `short_desc`, `status`) VALUES ('$categories_name', '$name', '$mrp', '$selling_price', '$qty', '$uniqFileName', '$meta_title', '$meta_short_desc', '$meta_desc', '$meta_keyword', '$description', '$short_desc', '1');";
            }

            $result = mysqli_query($conn, $sql);
            if ($result == 1) {
                header('location: product.php');
                $response = array(
                    "type" => "success",
                    "message" => "Updated successfully"
                );
            } else {
                $response = array(
                    "type" => "error",
                    "message" => "Problem While updating Category"
                );
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories | Code Shop</title>
</head>

<body class="bg-gray-300">
    <?php require("./assets/navbar.php"); ?>

    <div class="flex">
        <?php require("./assets/sidebar.php"); ?>
        <div class="flex flex-col bg-neutral m-4 rounded-lg text-white w-full min-h-screen items-center p-4">
            <div>
                <div class="overflow-x-auto text-black text-center">

                    <div class="w-9/12 m-auto">
                        <div class="container bg-gray-500 p-4 rounded-md h-fit w-fit">
                            <form action="<?php get_safe_value($conn, htmlspecialchars($_SERVER["PHP_SELF"])); ?>" method="post" enctype="multipart/form-data" class="space-y-4" enctype="multipart/form-data">

                                <!-- Messages are shown here -->
                                <?php if (!empty($response)) { ?>
                                    <h3 class="alert alert-<?php if (isset($response["type"])) echo  $response["type"]; ?> shadow-lg pl-8">
                                        <?php if(isset($response["message"])) echo $response["message"]; ?>
                                        <?php if(isset($response['ImageMessage'])) echo $response["ImageMessage"]; ?>
                                    </h3>
                                <?php } ?>

                                <div class="text-center font-bold text-3xl text-white mt-4">Add | Edit Product</div>
                                <select type="text" name="category_name" placeholder="Category Name" class="p-2 mt-4 rounded-md w-full border-2 border-black outline-none">
                                    <option>Select Category</option>
                                    <?php
                                    while ($category_row = mysqli_fetch_assoc($category_result)) {
                                        echo '<option value=' . $category_row['categories'] . '>' . $category_row['categories'] . '</option>';
                                    }
                                    ?>

                                </select>
                                <input type="text" value="<?php if (isset($row)) echo $row['name'] ?>" name="name" placeholder="Product Name" class="p-2 rounded-md w-full border-2 border-black outline-none" required>
                                <input type="file" value="<?php if (isset($row)) echo $row['image'] ?>" name="image" class="file-input file-input-bordered w-full max-w-xs" />
                                <input type="text" value="<?php if (isset($row)) echo $row['mrp'] ?>" name="mrp" placeholder="Product MRP" class="p-2 rounded-md w-full border-2 border-black outline-none" required>
                                <input type="text" value="<?php if (isset($row)) echo $row['selling_price'] ?>" name="selling_price" placeholder="Product Selling-Price" class="p-2 rounded-md w-full border-2 border-black outline-none" required>
                                <input type="text" value="<?php if (isset($row)) echo $row['qty'] ?>" name="qty" placeholder="Product Quantity" class="p-2 rounded-md w-full border-2 border-black outline-none" required>
                                <textarea name="short_desc" placeholder="Short Description" class="p-2 rounded-md w-full border-2 border-black outline-none" required><?php if (isset($row)) echo $row['short_desc'] ?></textarea>
                                <textarea name="description" placeholder="Description" class="p-2 rounded-md w-full border-2 border-black outline-none" required><?php if (isset($row)) echo $row['description'] ?></textarea>
                                <textarea name="meta_title" placeholder="Meta Title" class="p-2 rounded-md w-full border-2 border-black outline-none"><?php if (isset($row)) echo $row['meta_title'] ?></textarea>
                                <textarea name="meta_short_desc" placeholder="Meta short Description" class="p-2 rounded-md w-full border-2 border-black outline-none"><?php if (isset($row)) echo $row['meta_short_desc'] ?></textarea>
                                <textarea name="meta_desc" placeholder="Meta Description" class="p-2 rounded-md w-full border-2 border-black outline-none"><?php if (isset($row)) echo $row['meta_desc'] ?></textarea>
                                <textarea name="meta_keyword" placeholder="Meta Keyword" class="p-2 rounded-md w-full border-2 border-black outline-none"><?php if (isset($row)) echo $row['meta_keyword'] ?></textarea>
                                <button type="submit" name="addProduct" class="btn btn-md btn-info w-full text-white">Add Product</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <?php require("./assets/footer.php"); ?>

</body>
<script>

</script>

</html>