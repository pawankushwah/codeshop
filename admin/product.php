<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us Query | Code Shop</title>
</head>

<body class="bg-gray-300">
    <?php require("./assets/navbar.php"); ?>

    <div class="flex">
        <?php require("./assets/sidebar.php"); ?>
        <div class="flex flex-col bg-neutral m-auto rounded-lg text-blackl w-full h-fit items-center pl-96 pr-10 pb-10 overflow-x-auto space-y-2">
            <h1 class="text-center text-white text-3xl">Products</h1>
            <a href="manage-product.php" class="bg-white text-black rounded-md p-2"><span class="text-lg p-0 font-bold">+</span> Add Product</a>
            <?php
            // error_reporting(0);
            // category operations


            if (isset($_GET['type']) && $_GET['type'] == 'delete') {
                $id = $_GET['id'];
                $sql = "DELETE FROM PRODUCT WHERE `id`='$id'";
                $result = mysqli_query($conn, $sql);
            }

            $sql = "SELECT * FROM PRODUCT";
            $result = mysqli_query($conn, $sql);
            ?>
            <!-- Messages are shown here -->
            <!-- <?php if (!empty($response)) { ?>
                    <h3 class="alert alert-<?php if (isset($response["type"])) echo  $response["type"]; ?> shadow-lg pl-8">
                        <?php if (isset($response['message'])) echo $response["message"]; ?>
                    </h3>
                <?php } ?> -->

            <!-- <h1 class="text-center text-white pb-8">
                        <span class="text-2xl">Product</span>
                    </h1> -->
            <table class="table table-compact max-w-96">
                <thead>
                    <tr>
                        <td>#</td>
                        <td>id</td>
                        <td>category</td>
                        <td>Name</td>
                        <td>Image</td>
                        <td>MRP</td>
                        <td>Price</td>
                        <td>Quantity</td>
                        <td>Short Description</td>
                        <td>Description</td>
                        <td>Meta Title</td>
                        <td>Meta Short Description</td>
                        <td>Meta Description</td>
                        <td>Meta Keyword</td>
                        <td>Status</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php $i = 1;
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['categories_name'] ?></td>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['image'] ?></td>
                            <td><?php echo $row['mrp'] ?></td>
                            <td><?php echo $row['selling-price'] ?></td>
                            <td><?php echo $row['qty'] ?></td>
                            <td><?php echo $row['meta-title'] ?></td>
                            <td><?php echo $row['meta-desc'] ?></td>
                            <td><?php echo $row['meta-keyword'] ?></td>
                            <td><?php echo $row['description'] ?></td>
                            <td><?php echo $row['short-desc'] ?></td>
                            <td><?php echo $row['status'] ?></td>
                            <td></td>
                            <td class="text-white">
                                <a href="?type=delete&id=<?php echo $row['id']; ?>" class="btn btn-error">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td>#</td>
                        <td>id</td>
                        <td>category</td>
                        <td>Name</td>
                        <td>Image</td>
                        <td>MRP</td>
                        <td>Price</td>
                        <td>Quantity</td>
                        <td>Short Description</td>
                        <td>Description</td>
                        <td>Meta Title</td>
                        <td>Meta Short Description</td>
                        <td>Meta Description</td>
                        <td>Meta Keyword</td>
                        <td>Status</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>

    </div>
    <?php require("./assets/footer.php"); ?>

</body>
<script>

</script>

</html>