<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 26/10/2018
 * Time: 18:56
 */
$user = $_GET['user'];
$book = $_GET['book'];
$number = $_GET['number'];
$date = date("Y-m-d h:i:sa");

include 'dbh.inc.php';

$tabel = "transaction";
$sql = "INSERT INTO " . $tabel . " (date, user_id, book_id, nb_of_books) VALUES ('" .
    $date . "','" .
    $user ."','" .
    $book . "','" .
    $number . "')";

$result = $conn->query($sql);

if ($result) {
    $sql = "SELECT ID, date FROM ". $tabel. " WHERE date=\"". $date . "\" AND user_id=". $user . " AND book_id=". $book . " AND nb_of_books=". $number;
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    echo ($row['ID']);
}
else {
    echo "kacau";
}
