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
 
// Create connection 
$conn = mysqli_connect($dbserver,$dbuser,$dbpass); 
if(mysqli_connect_error()) { 
    die('Could not connect: ' . mysqli_connect_error()); 
} 

//finding in database 
mysqli_select_db($conn, "probookdb"); 
$sql = "SELECT username FROM user WHERE username = '$usernamelogin' and password = '$passwordlogin'"; 
$result = mysqli_query($conn,$sql); 
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);	
$count = mysqli_num_rows($result); 

// If result matched $usernamelogin and $passwordlogin, table row must be 1 row 
if($count === 1) { 
$uname = $usernamelogin; 
$ac_token = md5(mt_rand()); 
$ex_timestamp_database = time() + (60*60*24); 
$ex_timestamp_cookie = $ex_timestamp_database + (10*365*24*60*60); 
$ex_date_database = date('Y-m-d H:i:s', $ex_timestamp_database); 
setcookie("token",$ac_token,$ex_timestamp_cookie); 
$ipaddress = '';
if (isset($_SERVER['HTTP_CLIENT_IP']))
    $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
    $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
else if(isset($_SERVER['HTTP_X_FORWARDED']))
    $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
    $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
else if(isset($_SERVER['HTTP_FORWARDED']))
    $ipaddress = $_SERVER['HTTP_FORWARDED'];
else if(isset($_SERVER['REMOTE_ADDR']))
    $ipaddress = $_SERVER['REMOTE_ADDR'];
else
    $ipaddress = 'UNKNOWN';
return $ipaddress;

$dbserver = "127.0.0.1"; 
$dbuser = "root"; 
$dbpass = ""; 
$conn = mysqli_connect($dbserver,$dbuser,$dbpass); 

mysqli_select_db($conn,"wbd_schema"); 
mysqli_query($conn,"DELETE FROM token WHERE user_data=\"$uname\""); 
mysqli_query($conn,"INSERT INTO token (id,ip_address,user_agent,user_data,expiry_time,) VALUES (\"$ac_token\",\"$ipaddress\",\"$uname\",'$ex_date_database')"); 

mysqli_close($conn); 

header("Location: ../search_book.php?login=success");