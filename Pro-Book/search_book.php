<?php
/**
 * Created by PhpStorm.
 * User: secret
 * Date: 21/10/18
 * Time: 19:25
 */
if (isset($_COOKIE['access_token'])) {
} else {
    header("Location: login.php?sign-in-first-dude");
    exit();
}
?>
<!-- Insert HTML code here -->
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/application.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="css/navbar.css">
    <title>Search | Pro-book</title>
</head>
<body>
<?php include 'navbar.php'; ?>
<div class="container">
    <h1 class="arial">Search Book</h1>

    <form class="form-container" method="post" action="search_result.php">
        <input class ="search-book validate" type="text" name="searchbook" placeholder="Input search term...">
        <button type="submit" class="button submit-button" id="button-search" name="submit" onclick="return checkValidate()">Search</button>
    </form>
</div>

<script src="js/ajax.js"></script>
</body>