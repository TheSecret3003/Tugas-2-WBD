<?php
/**
 * Created by PhpStorm.
 * User: Albert's PC
 * Date: 10/26/2018
 * Time: 9:13 AM
 */
$name = $_POST['name'];
$address = $_POST['address'];
$phone_number = $_POST['phone_number'];
$card_number = $_POST['card_number'];
$ID = $_COOKIE['ID'];

$server = "localhost";
$db_username = "root";
$password = "";
$myDB = "probookdb";

echo $_FILES["profpic"]["name"];
if ($_FILES["profpic"]["name"]){
    require "upload.php";
}

try {
    $conn = new PDO("mysql:host=$server;dbname=$myDB", $db_username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "http://localhost:8081/validate");
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query(array("name" => $name, "card_number" => $card_number)));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $cn_validation_res = curl_exec($curl);
    curl_close($curl);

    if ($cn_validation_res == "OK"){
         if (isset($_FILES["profpic"]["name"])){
            $filename = $_FILES["profpic"]["name"];
            $query = "UPDATE user SET name = '$name', address = '$address', phone_number = '$phone_number', image = '$filename' , card_number = '$card_number' WHERE (ID = '$ID')";
        } else {
            $query = "UPDATE user SET name = '$name', address = '$address', phone_number = '$phone_number' , card_number = '$card_number' WHERE (ID = '$ID')";
        }

        $stmt = $conn->prepare($query);
        $stmt->execute();
    }

    header( 'Location: my_profile.php');
    die();

}
catch(PDOException $e)
{
    echo "<title>error</title>Error: " . $e->getMessage();
}
?>
