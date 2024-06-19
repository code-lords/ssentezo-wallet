<?php
require_once __DIR__. "/../vendor/autoload.php";

use SsentezoWallet\SsentezoWallet;

$username = "0cbe9588-b82d-4e16-a63d-3eeaf6fcdc68";
$password = "fa63b7aeb84edad1cf39a735825f2e59";
$wallet = new \Codelords\SsentezoWallet\SsentezoWallet($username, $password);
// $wallet->setEnvironment("sandbox");
// $res = $wallet->deposit("256771397135", 500, "TEST DEPOZITz", "Deposit from mtn account");
// $wallet->deposit('0756291975', 1000, 'selld', "NOlne", "ggggggg");
// $wallet->checkStatus('TEST DEPOZITz');
$wallet->checkStatus('1651714399166_4');
$res = $wallet->response;
// $data = $res->data;
// echo $res->message;
print_r($res);