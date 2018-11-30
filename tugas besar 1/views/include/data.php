<?php
/**
 * Created by PhpStorm.
 * User: Albert's PC
 * Date: 10/26/2018
 * Time: 1:00 PM
 */

    $servername = "localhost";
    $uname = "root";
    $pass = "";
    $myDB = "probookdb";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$myDB", $uname, $pass);

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "SELECT * FROM user WHERE ID = \"" . $_COOKIE['ID'] . "\"";


        $stmt = $conn->prepare($query);

        $stmt->execute();
        $row = $stmt->fetchAll();
        foreach ($row as $item) {
            $name = $item["name"];
            $email = $item["email"];
            $phone = $item["phone_number"];
            $address = $item["address"];
            $pic_path = $item["image"];
        }
    }
    catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }
?>