<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 26/10/2018
 * Time: 3:53
 */

$rating = $_POST["rating"];
$description = $_POST["comment"];
$user_id = $_COOKIE['ID'];
$book_id = $_POST["book-id"];
$ID = $_POST['transaction-id'];

include 'dbh.inc.php';
$TID = mysqli_real_escape_string($conn, $ID);
$tabel = "review";
$sql = "INSERT INTO " . $tabel . " (rating, description, user_id, book_id, transaction_id) VALUES ('" .
    $rating . "','" .
    $description ."','" .
    $user_id . "','" .
    $book_id . "','" .
    $ID . "')";
$result = $conn->query($sql);
echo ($sql);
if ($result) {
    header("Location: ../history.php?upload=success");
} else {
    header("Location: ../history.php?upload=failed");
}
exit();