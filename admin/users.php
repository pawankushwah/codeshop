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
        <div class="flex flex-col bg-neutral m-4 rounded-lg text-white w-full min-h-fit items-center p-4">
            <div>
                <?php
                // error_reporting(0);
                // category operations


                if (isset($_GET['type']) && $_GET['type'] == 'delete') {
                    $id = $_GET['id'];
                    $sql = "DELETE FROM USERS WHERE `id`='$id'";
                    $result = mysqli_query($conn, $sql);
                }

                $sql = "SELECT * FROM USERS";
                $result = mysqli_query($conn, $sql);
                ?>
                <div class="overflow-x-auto text-black text-center">

                    <!-- Messages are shown here -->
                    <?php if (!empty($response)) { ?>
                        <h3 class="alert alert-<?php if (isset($response["type"])) echo  $response["type"]; ?> shadow-lg pl-8">
                            <?php if (isset($response['message'])) echo $response["message"]; ?>
                        </h3>
                    <?php } ?>

                    <h1 class="text-center text-white pb-8">
                        <span class="float-left text-2xl">Users</span>
                    </h1>
                    <div class="rounded-lg float-left">
                        <table class="table w-1/4 mt-4">
                            <!-- head -->
                            <thead class="text-center">
                                <tr>
                                    <td>#</td>
                                    <td>Name</td>
                                    <td>Email</td>
                                    <td>Username</td>
                                    <td>Password</td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php $i = 1;
                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $row['name'] ?></td>
                                        <td><?php echo $row['email'] ?></td>
                                        <td><?php echo $row['username'] ?></td>
                                        <td><?php echo $row['password'] ?></td>
                                        <td class="text-white">
                                            <a href="?type=delete&id=<?php echo $row['id']; ?>" class="btn btn-error">Delete</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
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