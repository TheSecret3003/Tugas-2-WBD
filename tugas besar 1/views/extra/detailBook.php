<?php

$client = new SoapClient("http://localhost:9901/GetBookByID?wsdl");

error_reporting(E_ALL ^ E_WARNING);

$param = array(
    getBookByID => array (
        'id' => $_GET['id']
    )
);
$resp = $client->__soapCall("getBookByID", $param);
echo $resp->return;
?>
