<?php
/**
 * Created by PhpStorm.
 * User: Gery Wahyu
 * Date: 10/15/2018
 * Time: 9:21 AM
 */
if (isset($_COOKIE['access_token'])) {
    header("Location: search_book.php?you-are-signed-in");
    exit();
}
?>
<!-- Insert HTML code bellow -->
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/login-register.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <title>Register | Pro-book</title>
</head>
<body>
<br>
<form class="form-container" method="post" action="include/regist.php">
    <div class="bg"></div>
    <h1 class="bebas-neue">REGISTER</h1>
    <div class="input-container">
        <div class="input-element nunito">
            <label for="name">Name</label>
            <label>
                <input type="text" class="validate" name="name" >
            </label><br>
        </div>

        <div class="input-validation nunito" style="margin-right: 0">
            <label for="username" class="inline">Username</label>
            <div class="input-group inline" id="input-username">
                <input type="text" id="username" class="validate" name="username" style="width:140px; margin-right: 29px" onchange="checkUserName()">
<!--                <img src="../img/checklist.png" width="20px" height="20px">-->
            </div>
        </div>

        <div class="input-validation nunito" style="margin-right: 0">
            <label for="email" class="inline">Email</label>
            <div class="input-group inline" id="input-email">
                <input type="text" class="validate" id="email" name="email" style="width:140px;  margin-right: 29px" onchange="checkUserEmail()">
<!--                <img src="" width="20px" height="20px">-->
            </div>
        </div>

        <div class="input-element nunito">
            <label for="password">Password</label>
            <input type="password" class="validate" name="password" id="password"><br>
        </div>

        <div class="input-element nunito">
            <label for="confirm_password">Confirm Password</label>
            <input type="password" class="validate" name="confirm_password" id="confirm_password" onchange="checkUserPassword()"><br>
        </div>

        <div class="input-element nunito">
            <label for="address" style="vertical-align: top;">Address</label>
            <label for="title"></label>
            <textarea rows="5" class="validate" id="title" name="address" style="vertical-align: top; resize: none; width: 167px"></textarea>
        </div>

        <div class="input-element nunito">
            <label for="phone_number">Phone Number</label>
            <input type="text" class="validate" name="phone_number" id="phone_number" onchange="checkPhonePattern()"><br>
        </div>

        <div class="input-element nunito">
            <label for="card_number">Card Number</label>
            <input type="text" class="validate" name="card_number" id="card_number"><br>
        </div>
    </div>
    <a href="login.php" class="nunito block">Already have an account?</a>
    <button class="btn" name="submit" type="submit" onclick="return validate()">Register</button>
</form>

<script src="js/ajax.js"></script>
</body>
</html>