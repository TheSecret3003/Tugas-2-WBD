<?php
/**
 * Created by PhpStorm.
<<<<<<< Updated upstream
 * User: Albert's PC
 * Date: 10/24/2018
 * Time: 5:28 PM
 */
if (isset($_COOKIE['access_token'])) {
} else {
    header("Location: login.php?sign-in-first-dude");
    exit();
}
?>
<html>
<head>
    <link rel="stylesheet" href="css/application.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="css/navbar.css">
    <title>Edit Profile | Pro-Book</title>
</head>
<?php
    include 'include/data.php';
?>

<body>
<?php include 'navbar.php'; ?>
<div class="container">
    <div class="desc">
        <div class="inline">
        <h1 class="edit-p">Edit Profile</h1>
        </div>

        <div class="book-item inline">
            <form class="form-container" method="POST" action="update_db.php" enctype="multipart/form-data">
            <img class="pp-img left pp-img-frame" src=
            <?php
                echo "\"".$pic_path."\""
            ?>>
            <div class="inline description left">

            <p class="author">Update Profile Picture</p>
            <input class="nunito" type="text" id="fname" name="fname" value="<?php echo($row['image']) ?>">
                <div class="inline description right">
                <input id="profpic" name="profpic" id="profpic" type="file" class="browse-button">
                <button type="button"  class="button-detail" onclick="document.getElementById('profpic').click()">Browse ...</button>
                </div>
            </div>
            <div class="bg">

            </div>
            <div class="pp-container">
                <div class="pp-input-element nunito">
                    <label for="name">Name</label>
                    <input type="text" class="validate name-margin nunito" name="name" value="<?php echo($row['name']) ?>" id="name"><br>
                </div>

                <div class="pp-input-element nunito">
                    <label for="address" style="vertical-align: top;">Address</label>
                    <textarea rows="4" class="validate address-margin nunito" id="profile-address" name="address"><?php echo($row['address']) ?></textarea>
                </div>

                <div class="pp-input-element nunito">
                    <label for="phone_number">Phone Number</label>
                    <input type="text" class="validate phone-margin nunito" name="phone_number" value="<?php echo($row['phone_number']) ?>" id="phone_number"><br>
                </div>
                <div class="pp-input-element nunito">
                    <label for="card_number">Card Number</label>
                    <input type="text" class="validate card-margin nunito" name="card_number" value="<?php echo($row['card_number']) ?>" id="card_number"><br>
                </div>
            </div><br>
                <button class="button back-button" id="b-button">Back</button>
                <button class="button save-button" type="submit" name="submit" onclick="return validate()">Save</button>
            </form>
        </div>
    </div>

</div>
<script src="js/edit_profile.js"></script>
</body>
</html>
