<?php

namespace Codelords\SsentezoWallet\Response;


class PushToBankResponse extends Response
{

    public $message = "";

    public $errorCode;

    public function __construct(\Unirest\Response $res)
    {
        parent::__construct($res);
        $this->message = $this->data["message"] ?? "";
    }
}
