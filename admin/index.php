<?php
require("./connection.inc.php");
require("./function.inc.php");

// logining in the user
if(isset($_POST['login'])){
    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);

    $sql = "SELECT * FROM `admin_users` WHERE `username`='$username' AND `password`='$password'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if($num > 0){
        $_SESSION["ADMIN_LOGIN"] = 1;
        $_SESSION["ADMIN_USERNAME"] == $username;
        header("location: categories.php");
    }
    else{
        $response = array(
            "type"=>"error",
            "message"=>"Invalid Credentials"
        );
    }
}

// redirecting the user to admin dashboard if he is logged in 
if(isset($_SESSION['ADMIN_LOGIN']) && $_SESSION['ADMIN_LOGIN'] == 1){
    header("location:categories.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login | Code Shop</title>
    <link href="https://fonts.googleapis.com/css?family=Assistant:400,700" rel="stylesheet">
    <script defer src="./script.js"></script>
    <link rel="stylesheet" href="./css/style.css">

</head>

<body>
    <section class='login' id='login'>
        <div class='head'>
            <h1 class='company'>Code Shop</h1>
        </div>
        <p class='msg'>Welcome back</p>
        <div class='form'>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="text" placeholder='Username' class='text' id='username' name="username" required><br>
                <input type="password" placeholder='••••••••••••••' class='password' name="password" required><br>
                <button href="#" class='btn-login' id='do-login' name="login">Login</button>
                <a href="#" class='forgot'>Forgot?</a>
            </form>

            <div class="text-<?php if(isset($response)) echo $response['type']; ?>">
                <?php if(isset($response)) echo $response['message']; ?>
            </div>
        </div>
    </section>

</body>

</html>