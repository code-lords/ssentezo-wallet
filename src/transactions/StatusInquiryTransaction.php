<?php

namespace Codelords\SsentezoWallet\Transactions;

class StatusInquiryTransaction extends Transaction
{
    /**
     * @var string
     * The request id
     */
    public $request_id;

    /**
     * @var string
     * The external reference
     */
    public $externalReference;

    /**
     * @var string
     * The transaction amount
     */
    public $amount;

    /**
     * The reason for the transaction
     * @var string
     */
    public $reason;

    /**
     * @var string
     * The transaction status
     */
    public $status;

    /**
     * The currency of the transaction
     * @var string
     */
    public $currency;

    /**
     * The transaction reference by the network provider
     * @var string
     */
    public $network_ref;

    /**
     * The mobile money mobile number
     * @var string
     */
    public $msisdn;

    public function __construct($response)
    {
        parent::__construct($response);
        $this->request_id = $response->request_id;
        $this->externalReference = $response->externalReference;
        $this->amount = $response->amount;
        $this->reason = $response->reason;
        $this->status = $response->status;
        $this->currency = $response->currency;
        $this->network_ref = $response->network_ref;
        $this->msisdn = $response->msisdn;
    }
}
