<?php
/**
 * Created by PhpStorm.
 * User: secret
 * Date: 22/10/18
 * Time: 22:56
 */
include 'include/dbh.inc.php';
$usr = $_COOKIE['ID'];
$ID = mysqli_real_escape_string($conn, $usr);
$sql = "SELECT * FROM user WHERE ID='" . $ID . "'";
$result = mysqli_query($conn, $sql);
$row = $result->fetch_assoc();
?>
<!-- Insert HTML code here -->

<div class="navbar">
    <div class ="navbar-atas">
        <h1 class="inline">Pro<span class="white">-Book</span></h1>
        <div class="orange-box inline right" onclick="window.location.href='include/log_out.php'">
            <img src= "../img/po_button.png" class="icon"/>
        </div>
        <div class="height100 inline right vertical-center">
            <p class="height100">Hi, <?php echo($row['name']) ?></p>
        </div>
    </div>
    <div class="navbar-bawah">
        <ul>
            <?php
                $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];


                if ((strpos($url,'search') !== false) || (strpos($url,'detail') !== false)){
                    echo '<li><a class="active right-line" href="search_book.php"><span class="special-char">B</span>rowse</a></li>';
                } else {
                    echo '<li><a class="right-line" href="search_book.php"><span class="special-char">B</span>rowse</a></li>';
                }

                if ((strpos($url,'review') !== false) || (strpos($url,'history') !== false)){
                    echo '<li><a class="active right-line" href="history.php"><span class="special-char">H</span>istory</a></li>';
                } else {
                    echo '<li><a class="right-line" href="history.php"><span class="special-char">H</span>istory</a></li>';
                }

                if (strpos($url,'profile') !== false) {
                    echo '<li><a class="active" href="my_profile.php"><span class="special-char">P</span>rofile</a></li>';
                } else {
                    echo '<li><a href="my_profile.php"><span class="special-char">P</span>rofile</a></li>';
                }
            ?>
        </ul>
    </div>

</div>