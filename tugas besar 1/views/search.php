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
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.5/angular.js"></script>

    <title>Search | Pro-book</title>
</head>
<body ng-app = "search_app">
    <?php include 'navbar.php'; ?>
    <div class="container" ng-controller = "contentController">
        <h1 class="arial">{{title}}</h1>
        <div ng-show = "status" id="search">
            <form name="search_form" ng-submit = "submit()">
                <input class ="search-book validate" type="text" name="search_term" placeholder="Input search term..." ng-model = "search_term" required>
                <button type="submit" class="button submit-button" id="button-search" name="submit" ng-disabled = "search_form.search_term.$invalid">Search</button>
            </form>
        </div>
        <div ng-show = "!status">
            <div class="book-item inline" >
                <form ng-repeat="x in books"  class="form-container" method = "post" action = "book_detail.php" >
                    <input type="text" name="book-id" value='{{x.id}}' style='display:none;'>
                    <div style='display: block; overflow: auto'>
                        <img src = "{{x.image}}" class="book-img left book-img-frame" >
                        <div class="inline description left" >
                            <h4 class="title-desc" >{{x.name}}</h4 >
                            <h6 class="author" >{{x.author}}</h6 >
                            <p class="review" >{{x.description}}</p >
                        </div >
                        <div class= "price right" id="price_result">{{x.harga}}</div>
                        <button type = "submit" class="detail-button button submit-button" name= "submit"> Detail</button >
                    </div>
                </form >
            </div >
        </div>
    </div>

    <script src="./js/search.js"></script>
</body>