<?php

/* CHECK TOKEN */
$ac_token = $_COOKIE["access_token"]; 

$dbserver = '127.0.0.1'; 
$dbuser = 'root'; 
$dbpass = ''; 
$conn = mysqli_connect($dbserver,$dbuser,$dbpass); 

mysqli_select_db($conn,"probookdb"); 
$data = mysqli_query($conn,"SELECT * FROM token WHERE id=\"$ac_token\""); 
$data_1 = mysqli_fetch_assoc($data); 

if (($data_1["id"] !== $ac_token) || ($data_1["expiry_time"] < date('Y-m-d H:i:s',time()))){ 
    setcookie("access_token","",0); 
    setcookie("uname","",0); 

    header("Location: login.php"); 
} else { 
    $uname = $data_1["username"];
}