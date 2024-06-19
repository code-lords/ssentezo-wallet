<?php

namespace Codelords\SsentezoWallet\Response;


class WithdrawalResponse extends Response
{

    public $transactionStatus;
    public $ssentezoWalletReference;
    public $financialTransactionId;

    public $errorCode;

    public function __construct(\Unirest\Response $res)
    {
        parent::__construct($res);
        $this->transactionStatus = $this->data["transactionStatus"] ?? "";
        $this->ssentezoWalletReference = $this->data["ssentezoWalletReference"] ?? "";
        $this->financialTransactionId = $this->data['financialTransactionId'] ?? "";
    }
}
