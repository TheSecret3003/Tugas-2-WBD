<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 23/10/2018
 * Time: 22:37
 */
// Log in the user here
$cookie_name = "ID";
$cookie_value = $row['ID'];
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");

// giving access token
$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$charactersLength = strlen($characters);
$randomString = '';
for ($i = 0; $i < 10; $i++) {
    $randomString .= $characters[rand(0, $charactersLength - 1)];
}
$cookie_value = $randomString;
$cookie_name = "access_token";
setcookie($cookie_name, $cookie_value, time() + (60 * 30), "/");
header("Location: ../search_book.php?login=success");