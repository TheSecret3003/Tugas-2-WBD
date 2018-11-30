<?php
$client = new SoapClient("http://localhost:9901/GetBookByTitle?wsdl");
$param = array(
    getBookByTitle => array (
        'title' => $request->param['title']
    )
);
$resp = $client->__soapCall("getBookByTitle", $param);

?>
