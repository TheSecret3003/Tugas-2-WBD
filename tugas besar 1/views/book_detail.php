<?php
function  check_if_for_sale($status){
    if ($status->saleability == "NOT_FOR_SALE"){
        return NULL;
    } else {
        return $status->listPrice->amount;
    }
};

/**
 * Created by PhpStorm.
 * User: secret
 * Date: 25/10/18
 * Time: 7:38
 */
if (isset($_COOKIE['access_token'])) {
    //Error Handlers
    $bookID = $_POST["book-id"];
    // Check if inputs are empty
    if (empty($bookID)) {
        # code...
        header("Location: search.php?searchbook=empty");
        exit();
    } else {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "http://localhost/tubeswbd3/views/extra/detailBook.php?id=".$bookID);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        
        $resp = curl_exec($curl);
        curl_close($curl);
        $resp = json_decode($resp);

        $book = [
            "name"      => $resp->volumeInfo->title,
            "author"    => join(", ",$resp->volumeInfo->authors),
            "description"   => $resp->volumeInfo->description,
            "image"     => $resp->volumeInfo->imageLinks->thumbnail,
            "rating"    => round($resp->volumeInfo->averageRating),
            "price"     => check_if_for_sale($resp->saleInfo)
        ];
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
    <title>Review Page | Pro-book</title>
    <link rel="stylesheet" href="css/application.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/ajax-notification.css">
</head>
<body>
<div class="absolute-container" id="ac">
    <div class="box">
        <img src="../img/times-solid.png" class="right cross" onclick="turnover()">
        <div class="inline centerize flex">
            <img src="../img/check-solid.png" class="check flex">
            <div class="block">
                <p class="nunito notif"><b>Pemesanan Berhasil!</b></p>
                <p class="nunito notif" id="transactione">Nomor Transaksi : 3</p>
            </div>
        </div>
    </div>
</div>
<?php include 'navbar.php'; ?>
<div class="container">
    <div class="book-detail">
        <div class="deskripsi-buku">
            <h1 class="nunito"><?php echo($book['name']); ?></h1>
            <h2 class="nunito"><?php echo($book['author']); ?></h2>
            <p class="nunito"><?php echo($book['description']); ?></p>
        </div>
        <div class="book-image">
            <div class="image-contain">
                <img class="image-middle" src="<?php echo($book['image']); ?>">
            </div>
            <div class="rating-book">
                <?php
                    $iterate = 5;
                    $i = $book['rating'];
                    while ($iterate >= 1) {
                        if ($i > 1) {
                            echo("<img id=\"star1fill\" class=\"review-star\" src=\"../img/star-solid.png\">");
                        }
                        else {
                            echo("<img id=\"star5fill\" class=\"review-star\" src=\"../img/star-regular.png\">");
                        }
                        $iterate = $iterate - 1;
                        $i = $i - 1;
                    }

                ?>

            </div>
            <p class="nunito"><b><?php echo(number_format((float) ($book['rating']), 1, '.', '')); ?> / 5.0</b></p>
        </div>
    </div>
    <div class="order-detail">
        <h3 class="nunito-order">Order</h3>
        <?php
            if (!(is_null($book["price"]))){
                echo "
                    <div class= 'price'>".$book['price']."</div>
                    <div class='select-contain'>
                        <span class='nunito-jumlah'> Jumlah :</span>
                        <select class='select-number' id='nb-of-books'>
                            <option value='1' class='nunito'>1</option>
                            <option value='2' class='nunito'>2</option>
                            <option value='3' class='nunito'>3</option>
                            <option value='4' class='nunito'>4</option>
                            <option value='5' class='nunito'>5</option>
                        </select>
                    </div>

                    <div id='book-id' style='display: none'>".$bookID."</div>
                    <div id='user-id' style='display: none'>".$_COOKIE['ID']."</div>

                    <button class='order-button' name='submit' type='submit' onclick='makeTransaction()'>Order</button>
                ";
            } else {
                echo "
                    <div class= 'price'>Book is not for sale.</div>
                ";
            }
        ?>
    </div>

    <div class="reviews">
        <h4 class="nunito-reviews">Reviews</h4>
        <?php
        foreach ($review as $row) {
            echo ("
        <div class=\"review-container\">
        <div class=\"image-contains\">
            <img src=\"". $row['image'] ."\">
        </div>

        <div class=\"detail-review\">
            <h5 class=\"nunito\">@". $row['username'] ."</h5>
            <p class=\"nunito\">". $row['description'] ."</p>
        </div>
        <div class=\"contain-star\">
            <img src=\"../img/star-solid.png\">
            <p class=\"nunito\"><b>" . number_format((float) ($row['rating']), 1, '.', '') . " / 5.0</b></p>
             <div class= \"price right\">".$row['harga']."
        </div>
        </div>
        ");
        }
        ?>
    </div>
</div>

<script src="js/notif.js"></script>
</body>
</html>