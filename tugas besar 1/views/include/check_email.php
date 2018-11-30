<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 23/10/2018
 * Time: 14:50
 */
$email = $_GET['email'];

if ($email !== "") {
    include 'dbh.inc.php';
    $usermail = mysqli_real_escape_string($conn, $email);
    $sql = "SELECT * FROM user WHERE email='" . $usermail . "'";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck < 1) {
        echo "aman";
    } else {
        echo $sql;
    }
    exit();
}
else {
    echo $_SERVER['REQUEST_URI'];
    exit();
}