<?php

namespace SsentezoWallet;

class Response
{
    public $message;
    public $status;
    public $errorCode;
    public $data;
    public function __construct(\Unirest\Response $res)
    {
        $body = $res->body;
        $this->errorCode = $body->errorCode;
        $this->message = $body->message;
        $this->status = $body->status;
        $this->data = (array)$body->data;
    }
}
