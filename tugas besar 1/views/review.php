<?php
/**
 * Created by PhpStorm.
 * User: secret
 * Date: 21/10/18
 * Time: 19:25
 */
if (isset($_COOKIE['access_token'])) {
    include 'include/dbh.inc.php';

    $bookID = mysqli_real_escape_string($conn, $_POST['book-id']);

    //Error Handlers
    // Check if inputs are empty
    if (empty($bookID)) {
        # code...
        header("Location: history.php?bookID=empty");
        exit();
    } else {
        // Getting book info and rating
        $sql = "SELECT book.name, book.image, book.author FROM book WHERE book.ID = ". $bookID;
        $result = mysqli_query($conn, $sql);
        $book = $result->fetch_assoc();
    }
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
    <title>Review | Pro-book</title>
</head>
<body>
<?php include 'navbar.php'; ?>
<br><br>
<div class="container">
    <div class="desc">
        <div class="inline">
            <h1 class="arial"><?php echo($book['name']); ?></h1>
            <p class="author"><?php echo($book['author']); ?></p>
        </div>
        <img src="<?php echo($book['image']); ?>" class="book-img right book-img-frame">
    </div>

    <form method = "post" action = "include/submit-post.php" >
        <h2 class="arial coral">Add Rating</h2>
        <input class="validate" type="text" name="rating" id="rating" style="display: none">
        <input class="validate" type="text" name="book-id" value= <?php echo($_POST["book-id"]);?> style='display:none;'>
        <input class="validate" type="text" name="transaction-id" id="rating" value="<?php echo($_POST['transaction-id']);?>"style="display: none">
        <div class="rating">
            <input type="radio" id="star1">
            <label for="star1" onclick="changeRating(1)" onmouseover="drawStar(1)" onmouseleave="reloadStar()">
                <img src="../img/star-regular.png" class="star-image"/>
            </label>
            <input type="radio" id="star2">
            <label for="star2" onclick="changeRating(2)" onmouseover="drawStar(2)" onmouseleave="reloadStar()">
                <img src="../img/star-regular.png" class="star-image"/>
            </label>
            <input type="radio" id="star3">
            <label for="star3" onclick="changeRating(3)" onmouseover="drawStar(3)" onmouseleave="reloadStar()">
                <img src="../img/star-regular.png" class="star-image"/>
            </label>
            <input type="radio" id="star4">
            <label for="star4" onclick="changeRating(4)" onmouseover="drawStar(4)" onmouseleave="reloadStar()">
                <img src="../img/star-regular.png" class="star-image"/>
            </label>
            <input type="radio" id="star5">
            <label for="star5" onclick="changeRating(5)" onmouseover="drawStar(5)" onmouseleave="reloadStar()">
                <img src="../img/star-regular.png" class="star-image"/>
            </label>
        </div>

        <h2 class="arial coral">Add Comment</h2>

        <textarea class="validate" name="comment" placeholder="Write your comments..."></textarea>
        <button class="button back-button"onclick="window.location.href='history.php'">Back</button>
        <button type="submit" name="submit" class="button submit-button" onclick="return checkValidate()">Submit</button>
    </form>

</div>

<script src="js/ajax.js"></script>
<script src="js/star.js"></script>
</body>