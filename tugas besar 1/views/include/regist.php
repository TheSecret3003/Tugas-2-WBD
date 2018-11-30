<?php
    $name = $_POST["name"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $address = $_POST["address"];
    $phone_number = $_POST["phone_number"];
    $image = "../img/book.jpg";
    $card_number = $_POST["card_number"];

    include 'dbh.inc.php';

    $name = str_replace("+", " ", $name);

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "http://localhost:8081/validate");
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query(array("name" => $name, "card_number" => $card_number)));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $cn_validation_res = curl_exec($curl);
    curl_close($curl);

    if ($cn_validation_res == "OK"){
        $sql = "INSERT INTO user (email, password, address, username, name, phone_number, image, card_number) VALUES (\"$email\",\"$password\",\"$address\",\"$username\",\"$name\",\"$phone_number\",\"$image\",\"$card_number\")";

        #echo ($sql);
        $result = $conn->query($sql);

        if ($result) {
            $sql = "SELECT * FROM user WHERE username='" . $username . "'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            include 'set_cookie.php';
        }
        else {
            echo mysqli_error($conn);
            header("Location: ../register.php?login=failAddingDataToDB");
            exit();
        }
    } else {
        header("Location: ../register.php?login=wrongCardNumber");
        exit();
    }
?>