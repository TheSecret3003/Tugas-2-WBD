<?php
/**
 * Created by PhpStorm.
 * User: Albert's PC
 * Date: 10/25/2018
 * Time: 1:22 PM
 */
$target_dir = "../img/profpic/";
$target_file = $target_dir.$_COOKIE["ID"].".jpg";
echo $_FILES["profpic"]["name"];

$renamed = $target_dir.$_COOKIE['ID'].".jpg";
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["profpic"]["tmp_name"]);
    if($check !== false) {
        echo "File adalah gambar - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File bukan merupakan gambar";
        $uploadOk = 0;
    }
}

if ($_FILES["profpic"]["size"] > 500000000) {
    echo "Ukuran file terlalu besar!";
    $uploadOk = 0;
}

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    echo "Upload file JPG/JPEG/PNG/GIF!";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    echo "Foto profil tidak dapat diupload.";

} else {
    if(file_exists($target_file)) {
        chmod($target_file,0755); //Change the file permissions if allowed
        unlink($target_file); //remove the file
    }
    if (move_uploaded_file($_FILES["profpic"]["tmp_name"], $target_file)) {
        echo "Gambar ". basename( $_FILES["profpic"]["name"]). " sudah berhasil diupload.";
    } else {
        echo "Ulangi upload foto profil!";
    }
}
?>

