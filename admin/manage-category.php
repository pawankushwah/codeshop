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
            <div id="categories" class="tabcontent">
                <?php
                error_reporting(0);

                // category operations
                $category = '';

                // showing the value of clicked category
                if (isset($_GET['type']) && $_GET['type'] == 'edit') {
                    if (isset($_GET['category']) && $_GET['category'] != '') {
                        $category = get_safe_value($conn, $_GET['category']);

                        $sql = "SELECT * FROM $CATEGORY WHERE `categories`='$category'";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);
                    }
                }

                // updating category
                if (isset($_POST['updateCategory'])) {
                    $newCategoryName = get_safe_value($conn, $_POST['category']);

                    $existsql = "SELECT * FROM $CATEGORY WHERE categories='$newCategoryName';";
                    $result = mysqli_query($conn, $existsql);
                    $num = mysqli_num_rows($result);

                    if ($num > 0) {
                        $response = array(
                            "type" => "error",
                            "message" => "category Already Exist"
                        );
                    } else {
                        // checking whether you came from category page or by url and forming sql accordingly
                        if (isset($_GET['category']) && $_GET['category'] != '') {
                            $category = get_safe_value($conn, $_GET['category']);
                            $sql = "UPDATE $CATEGORY SET `categories`='$newCategoryName', `status`='1' WHERE `categories`='$category'";
                        } else {
                            $sql = "INSERT INTO $CATEGORY (`categories`,`status`) VALUES ('$newCategoryName','1')";
                        }

                        $result = mysqli_query($conn, $sql);
                        if ($result == 1) {
                            header('location:categories.php');
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


                ?>
                <div class="overflow-x-auto text-black text-center">

                    <div class="w-9/12 m-auto">
                        <form action="<?php get_safe_value($conn, htmlspecialchars($_SERVER["PHP_SELF"])); ?>" method="post" enctype="multipart/form-data">
                            <div class="container bg-gray-500 p-4 rounded-md h-fit w-fit">

                                <!-- Messages are shown here -->
                                <?php if (!empty($response)) { ?>
                                    <h3 class="alert alert-<?php if (isset($response["type"])) echo  $response["type"]; ?> shadow-lg pl-8">
                                        <?php echo $response["message"]; ?>
                                    </h3>
                                <?php } ?>

                                <div class="text-center font-bold text-3xl text-white mt-4">Update category</div>
                                <input type="text" name="category" placeholder="Category Name" value="<?php echo $category; ?>" class="p-2 mt-4 rounded-md w-full border-2 border-black outline-none">
                                <button type="submit" name="updateCategory" class="btn btn-md btn-info w-full mt-4 text-white">Update category</button>
                            </div>
                        </form>
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