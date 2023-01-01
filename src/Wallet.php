<?php

namespace Codelords\SsentezoWallet;

use Exception;
use Unirest\Request;

/**
 * This is the class with the basic wallet operations
 */
class Wallet
{
    protected function sendRequest()
    {
        try {
            $headers = array('Content-Type: multipart/form-data');
            $body = $this->payload;
            Request::auth($this->username, $this->password);
            $response = Request::post($this->endPoint, $headers, $body);
        } catch (Exception $e) {
            print_r($e);
        }
        return $response;
    }
}
