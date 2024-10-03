<?php

namespace Codelords\SsentezoWallet\Response;


class PushToBankStatusResponse extends Response
{

    public $message = "";

    public $errorCode;
    public $transactionStatus;
    public $ssentezoWalletReference;
    public $externalReference;
    public $amount;
    public $transactionTime;

    public function __construct(\Unirest\Response $res)
    {
        parent::__construct($res);
        $this->message = $this->data["message"] ?? "";
        $this->transactionStatus = $this->data["transactionStatus"] ?? "";
        $this->externalReference = $this->data["externalReference"] ?? "";
        $this->ssentezoWalletReference = $this->data["ssentezoWalletReference"] ?? "";
        $this->amount = $this->data["amount"] ?? "";
        $this->transactionTime = $this->data["transactionTime"] ?? "";
    }
}
