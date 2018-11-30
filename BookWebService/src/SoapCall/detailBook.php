<?php

$client = new SoapClient("http://localhost:9901/GetBookByID?wsdl");
$param = array(
    getBookByID => array (
        'id' => $request->param['id']
    )
);
$resp = $client->__soapCall("getBookByID", $param);

?>
