<?php
/**
 * Created by PhpStorm.
 * User: Albert's PC
 * Date: 10/23/2018
 * Time: 11:36 PM
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
    <title>My Profile | Pro-Book</title>
</head>
<body>
<?php include 'navbar.php'; ?>

<div class="special-container">
    <div class="solid-box">
        <a href="edit_profile.php">
            <img src="../img/pencil.jpg" class="pencil-image">
        </a><br><br>
        <img src="<?php echo($row['image']) ?>" class="img-circle" id="pp">
        <p class="centre profile-name"><?php echo($row['name']) ?></p>
    </div>
    <div class="desc">
        <div class="inline">
            <h2 class="header-profile">My Profile</h2>
        </div>

        <div class="space">
            <div class="inline">
                <img src="../img/user.png" class="left picture-frame">
            </div>
            <div class="inline">
                <p class="profile-desc">Username</p>
            </div>
            <div class="inline">
                <p class="detail-username-desc">@<?php echo($row['username']) ?></p>
            </div>
        </div>

        <div class="space">
            <div class="inline">
                <img src="../img/mail.png" class="left picture-frame">
            </div>
            <div class="inline">
                <p class="profile-desc">Email</p>
            </div>
            <div class="inline">
                <p class="detail-mail-desc"><?php echo($row['email']) ?></p>
            </div>
        </div>

        <div class="space">
            <div class="inline">
                <img src="../img/home.png" class="left picture-frame">
            </div>
            <div class="inline">
                <p class="profile-desc">Address</p>
            </div>
            <div class="inline">
                <p class="detail-address-desc"><?php echo($row['address']) ?></p>
            </div>
        </div>

        <div class="space">
            <div class="inline">
                <img src="../img/phone.png" class="left picture-frame">
            </div>
            <div class="inline">
                <p class="profile-desc">Phone Number</p>
            </div>
            <div class="inline">
                <p class="detail-phone-desc"><?php echo($row['phone_number']) ?></p>
            </div>
        </div>

        <div class="space">
            <div class="inline">
                <img src="../img/card.png" class="left picture-frame">
            </div>
            <div class="inline">
                <p class="profile-desc">Card Number</p>
            </div>
            <div class="inline">
                <p class="detail-card-desc"><?php echo($row['card_number']) ?></p>
            </div>
        </div>        

    </div>

</div>
</body>
