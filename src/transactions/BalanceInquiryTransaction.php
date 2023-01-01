<?php

namespace Codelords\SsentezoWallet\Transactions;

class BalanceInquiryTransaction extends Transaction
{
    /**
     * @var float 
     * The account balance
     */
    public $amount;

    /**
     * @var string
     * The account balance formatted
     */
    public $formattedAmount;

    /**
     * @var string
     * The currency of the account
     */
    public $currency;

    public function __construct($response)
    {
        parent::__construct($response);
        $this->amount = $response->data->amount;
        $this->formattedAmount = $response->data->formatted;
        $this->currency = $response->data->currency;
    }
}
