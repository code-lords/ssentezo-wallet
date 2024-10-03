<?php

namespace Codelords\SsentezoWallet\Response;


class PushToBankResponse extends Response
{

    public $message = "";

    public $errorCode;

    public $transactionStatus;
    public $ssentezoWalletReference;
    public $externalReference;

    public function __construct(\Unirest\Response $res)
    {
        parent::__construct($res);
        $this->message = $this->data["message"] ?? "";
        $this->transactionStatus = $this->data["transactionStatus"] ?? "";
        $this->externalReference = $this->data["externalReference"] ?? "";
    }
}
