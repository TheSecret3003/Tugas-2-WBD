<?php
/**
 * Created by PhpStorm.
 * User: Albert's PC
 * Date: 10/19/2018
 * Time: 4:27 PM
 */
if (isset($_COOKIE['access_token'])) {
    include 'include/dbh.inc.php';

    $searchbook = mysqli_real_escape_string($conn, $_POST['searchbook']);

    //Error Handlers
    // Check if inputs are empty
    if (empty($searchbook)) {
        # code...
        header("Location: search_book.php?searchbook=". $searchbook);
        exit();
    } else {
        $sql = "SELECT book.name as name, book.ID as ID, book.author as author, book.description as description, AVG(review.rating) as rating, COUNT(review.ID) as reviewer, book.image as image, book.harga as harga FROM book LEFT OUTER JOIN review ON book.ID = review.book_id WHERE book.name LIKE \"%$searchbook%\" GROUP BY book.ID";
        $result = mysqli_query($conn, $sql);
        if ($result){
            echo "true";
        } else {
            echo mysqli_error($conn);
            echo "false";
        }

        $resultCheck = mysqli_num_rows($result);
        $table = array();
        while ($row = $result->fetch_assoc()) {
            array_push($table, $row);
        }
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
    <title>Search | Pro-book</title>
</head>
<body>
<?php include 'navbar.php'; ?>
<br>
<div class="container">
    <div class ="heading-container inline">
        <h1 class="inline">Search Result</h1>
        <h2 class="inline right">Found <span class="underline"><?php echo($resultCheck) ?></span> result(s)</h2>
    </div>
    <?php
    foreach ($table as $row) {
        echo("
        <div class=\"book-item inline\" >
        <form class=\"form-container\" method = \"post\" action = \"book_detail.php\" >
            <input type=\"text\" name=\"book-id\" value='". $row['ID'] ."' style='display:none;'>
            <div style='display: block; overflow: auto'>
                <img src = \"". $row['image'] ."\" class=\"book-img left book-img-frame\" >
                <div class=\"inline description left\" >
                    <h4 class=\"title-desc\" > ". $row['name'] ."</h4 >
                    <h6 class=\"author\" >". $row['name'] . " - " . number_format((float) ($row['rating']), 1, '.', '') . " / 5.0 (" . $row['reviewer'] . " votes)</h6 >
                    <p class=\"review\" >". $row['description'] ."</p >
                </div >
                <div class= \"price right\">".$row['harga']."
                </div>
                
            </div>
            <button type = \"submit\" class=\"detail-button button submit-button\" name= \"submit\"> Detail</button >
        </form >
        </div >");
    }
    ?>
</div>
</body>
</html>
