<?php

namespace Codelords\SsentezoWallet\Response;


class TransactionStatusResponse extends Response
{

    public $transactionStatus;
    public $ssentezoWalletReference;
    public $externalReference;
    public $financialTransactionId;
    public $amount;
    public $reason;
    public $currency;
    public $msisdn;
    public $transactionTime;


    public function __construct(\Unirest\Response $res)
    {
        parent::__construct($res);
        $this->transactionStatus = $this->data["transactionStatus"] ?? "";
        $this->ssentezoWalletReference = $this->data["ssentezoWalletReference"] ?? "";
        $this->financialTransactionId = $this->data['financialTransactionId'] ?? "";
        $this->externalReference = $this->data['externalReference'] ?? "";
        $this->amount = $this->data['amount'] ?? "";
        $this->reason = $this->data['reason'] ?? "";
        $this->currency = $this->data['currency'] ?? "";
        $this->msisdn = $this->data['msisdn'] ?? "";
        $this->transactionTime = $this->data['transactionTime'] ?? "";
    }
}
