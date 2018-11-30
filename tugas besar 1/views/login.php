<?php
/**
 * Created by PhpStorm.
 * User: Gery Wahyu
 * Date: 10/15/2018
 * Time: 9:18 AM
 */
if (isset($_COOKIE['access_token'])) {
    header("Location: search_book.php?you-are-signed-in");
    exit();
}
?>
<!-- Insert HTML code here -->
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/login-register.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <title>Login | Pro-book</title>
</head>
<body>
<form class="form-container" method="post" action="include/sign_in.php" id="login-page">
    <div class="bg"></div>
    <h1 class="bebas-neue">LOGIN</h1>
    <div class="input-container">
        <div class="input-element nunito">
            <label for="username">Username</label>
            <input type="text" name="username" class="validate"><br>
        </div>

        <div class="input-element nunito">
            <label for="password">Password</label>
            <input type="password" name="password" class="validate"><br>
        </div>

    </div>
    <br>
    <a href="register.php" class="nunito">Don't have an account?</a>
    <div>
        <input class="login-container" type="submit" value="LOGIN" name="submit" onclick="return checkValidate()"><br>
    </div>

</form>

<script src="js/ajax.js"></script>
</body>
</html>