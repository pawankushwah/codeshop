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
                if (isset($_GET['id']) && $_GET['id'] != '') {
                    $id = get_safe_value($conn, $_GET['id']);
                }

                if(isset($_GET['category']) && $_GET['category'] != ''){
                    $category = get_safe_value($conn, $_GET['category']);
                }

                if (isset($_GET['type']) && $_GET['type'] == 'category') {
                    if (isset($_GET['operation'])) {
                        if ($_GET['operation'] == 'active') {
                            $status = '1';
                        } else if ($_GET['operation'] == 'deactive') {
                            $status = '0';
                        } else {
                            $response = array(
                                "type" => "error",
                                "message" => "Invalid Parameters"
                            );
                        }
                    } else {
                        $response = array(
                            "type" => "error",
                            "message" => "Invalid Parameters"
                        );
                    }
                    if ($response['type'] != "error") {
                        $sql = "UPDATE $CATEGORY SET `status`='$status' WHERE `categories`='$category'";
                        $result = mysqli_query($conn, $sql);
                    }
                }

                if (isset($_GET['type']) && $_GET['type'] == 'delete') {
                    $sql = "DELETE FROM $CATEGORY WHERE `categories`='$category'";
                    $result = mysqli_query($conn, $sql);
                }

                $sql = "SELECT * FROM $CATEGORY";
                $result = mysqli_query($conn, $sql);
                ?>
                <div class="overflow-x-auto text-black text-center">

                    <!-- Messages are shown here -->
                    <?php if (!empty($response)) { ?>
                        <h3 class="alert alert-<?php if (isset($response["type"])) echo  $response["type"]; ?> shadow-lg pl-8">
                            <?php if(isset($response['message'])) echo $response["message"]; ?>
                        </h3>
                    <?php } ?>

                    <h1 class="text-center text-white pb-8">
                        <span class="float-left text-2xl">Categories</span>
                        <a href="add-category.php" class="float-right bg-white text-black rounded-md p-2"><span class="text-lg p-0 font-bold">+</span> Add category</a>
                    </h1>
                    <table class="table w-full mt-4">
                        <!-- head -->
                        <thead class="text-center">
                            <tr>
                                <td>S.No.</td>
                                <td>category</td>
                                <td>status</td>
                                <td>function</td>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php $i = 1; while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $row['categories'] ?></td>
                                    <td>
                                        <?php
                                        if ($row['status'] == 1) echo "<a href='?type=category&operation=deactive&category=" . $row['categories'] . "' class='btn btn-success'>active</a>";
                                        else echo "<a href='?type=category&operation=active&category=" . $row['categories'] . "' class='btn btn-error'>deactive</a>";
                                        ?>
                                    </td>
                                    <td class="space-x-2 text-white">
                                        <a href="?type=delete&category=<?php echo $row['categories']; ?>" class="btn btn-error">Delete</a>
                                        <a href="manage-category.php?type=edit&category=<?php echo $row['categories']; ?>" class="btn btn-square">Edit</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <?php require("./assets/footer.php"); ?>

</body>
<script>

</script>

</html>