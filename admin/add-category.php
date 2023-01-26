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
        <div class="flex flex-col bg-neutral m-4 rounded-lg text-white w-full min-h-fit max-h-96 items-center p-4">
            <div>
                <?php
                ob_start();
                error_reporting(0);
                // category operations
                if (isset($_POST['addCategory'])) {
                    $categoryName = get_safe_value($conn,$_POST['category']);

                    $existsql = "SELECT * FROM $CATEGORY WHERE categories='$categoryName';";
                    $result = mysqli_query($conn, $existsql);
                    $num = mysqli_num_rows($result);

                    if ($num > 0) {
                        $response = array(
                            "type" => "error",
                            "message" => "category Already Exist"
                        );
                    } else {
                        $sql = "INSERT INTO $CATEGORY (`categories`, `status`) VALUES ('$categoryName', '1');";
                        $result = mysqli_query($conn, $sql);
                        if ($result == 1) {
                            header("location: categories.php");
                            $response = array(
                                "type" => "success",
                                "message" => "Added successfully <script>window.location.href='categories.php';</script>"
                            );
                        } else {
                            $response = array(
                                "type" => "error",
                                "message" => "Problem While Adding Category"
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

                                <div class="text-center font-bold text-3xl text-white mt-4">Add category</div>
                                <input type="text" name="category" placeholder="Category Name" class="p-2 mt-4 rounded-md w-full border-2 border-black outline-none">
                                <button type="submit" name="addCategory" class="btn btn-md btn-info w-full mt-4 text-white">Add category</button>
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