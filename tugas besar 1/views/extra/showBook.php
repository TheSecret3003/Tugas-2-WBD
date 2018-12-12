<?php
$client = new SoapClient("http://localhost:9901/GetBookByTitle?wsdl");

error_reporting(E_ALL ^ E_WARNING);

$param = array(
    getBookByTitle => array (
        'title' => $_GET['title']
    )
);

$resp = $client->__soapCall("getBookByTitle", $param);
echo $resp->return;
?>
