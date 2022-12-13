<?php
require_once "../vendor/autoload.php";

use SsentezoWallet\SsentezoWallet;

$username = "523d142a-725a-440e-95f4-3bb6c78889ec";
$password = "3f4b7f66e33b853e7f49d4b2a556edaf";
$wallet = new SsentezoWallet($username, $password);
// $wallet->setEnvironment("sandbox");
// $res = $wallet->withdraw("0771397135", 1000, "gabcdefl'ko", "Deposit to my account", "https://www.google.com");
$res = $wallet->deposit('0756292975', 1000, 'sed', "NOne", "ggggggg");
print_r($res);
