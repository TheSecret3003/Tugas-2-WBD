<?php
/**
 * Created by PhpStorm.
 * User: afais
 * Date: 30/11/2018
 * Time: 22:43
 */
$client = new SoapClient("http://localhost:9901/BuyBookByID?wsdl");
$param = array(
    buyBookByID => array (
        'id' => $request->param['id'],
        'amount' => $request->param['amount'].
        'Rekening' => $request->param['rekening'],
        'category' => $request->param['category'],
        'price' => $request->param['price'],
        'ordertime' => $request->param['oredertime']
    )
);
$resp = $client->__soapCall("buyBookByID", $param);
