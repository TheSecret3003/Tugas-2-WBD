<?php
/**
 * Created by PhpStorm.
 * User: Albert's PC
 * Date: 10/23/2018
 * Time: 1:40 PM
 */
function tgl_indo($tanggal){
    $bulan = array (
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tanggal);

    $tanggal = explode(' ', $pecahkan[2]);
    // variabel pecahkan 0 = tanggal
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tahun

    return $tanggal[0] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}

if (isset($_COOKIE['access_token'])) {
    include 'include/dbh.inc.php';

    $usr = $_COOKIE['ID'];

    $sql = "SELECT book.name as bookName, transaction.nb_of_books as nbBook, transaction.ID as orderNumber, transaction.date as orderDate, review.ID as reviewResult, book.image as image, book.ID as bookId FROM transaction LEFT OUTER JOIN review ON transaction.ID = review.transaction_id JOIN book ON book.ID = transaction.book_id WHERE transaction.user_id = ". $usr ." ORDER BY transaction.date DESC";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    $table = array();
    while ($row = $result->fetch_assoc()) {
        array_push($table, $row);
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
    <title>History | Pro-Book</title>
</head>
<body>
<?php include 'navbar.php'; ?>
<div class="container">
    <div class="desc">
        <div class="inline">
            <h1 class="arial">History</h1>
        </div>

        <?php
        foreach ($table as $row) {
            echo("
        <div class=\"book-item\">
            <img src=\"". $row['image'] ."\" class=\"book-img left book-img-frame\">
            <div class=\"inline description left\">
                <h4 class=\"history-title-desc\">". $row['bookName'] . "</h4>
                <p class=\"ordered-review\">Jumlah : ". $row['nbBook'] . "</p>");

            if (is_null($row['reviewResult'])) {
                echo("<p class=\"ordered-review\">Belum direview</p>");
            }
            else {
                echo("<p class=\"ordered-review\">Anda sudah memberikan review</p>");
            }

            echo("
            </div>
            <div class=\"inline description right\">
                <p class=\"date-order-details\">". tgl_indo($row['orderDate']) . "</p>
                <p class=\"date-order-details\">Nomor Order : #". $row['orderNumber'] . "</p>");

            if (is_null($row['reviewResult'])) {
                echo("
        <form class=\"form-container\" method = \"post\" action = \"review.php\">
            <input type=\"text\" name=\"transaction-id\" value=\"". $row['orderNumber'] ."\" style='display:none;'>
            <input type=\"text\" name=\"book-id\" value=\"". $row['bookId'] ."\" style='display:none;'>
            <button type=\"submit\" class=\"button submit-button\" name=\"submit\">Review</button>
        </form>");
            }

            echo("
            </div>
        </div>");
         }
        ?>


    </div>
    <br><br>

</div>
</body>
