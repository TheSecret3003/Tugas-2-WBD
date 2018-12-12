<?php
$client = new SoapClient("http://localhost:9901/GetRecomendedBook?wsdl");
$param = array(
    getRecomendedBook => array (
        'category' => $request->param['category']
    )
);
$resp = $client->__soapCall("getRecomendedBook", $param);

?>
