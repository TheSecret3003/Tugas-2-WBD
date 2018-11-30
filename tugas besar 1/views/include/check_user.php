<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 23/10/2018
 * Time: 14:05
 */
$usr = $_GET['usr'];

if ($usr !== "") {
    include 'dbh.inc.php';
    $username = mysqli_real_escape_string($conn, $usr);
    $sql = "SELECT * FROM user WHERE username='" . $username . "'";
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