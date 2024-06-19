<?php

namespace Codelords\SsentezoWallet\Response;



class AccountBalanceResponse extends Response
{

    public $amount;
    public $amountFormatted;
    public $currency;

    public function __construct(\Unirest\Response $res)
    {
        parent::__construct($res);
        $this->amount = $this->data["amount"] ?? "";
        $this->amountFormatted = $this->data["formatted"] ?? "";
        $this->currency = $this->data['currency'] ?? "";
    }
}
