<?php /** @noinspection PhpUndefinedMethodInspection */
include_once dirname(__FILE__) . '/router/Request.php';
include_once dirname(__FILE__) . '/router/Router.php';
include_once dirname(__FILE__) . '/controller/UserController.php';

$router = new Router(new Request);
$router->get('/', function () {
    header("Location: views/search_book.php");
});