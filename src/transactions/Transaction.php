<?php

namespace Codelords\SsentezoWallet\Transactions;

/**
 * This class represents a transction in ssentezo wallet.
 * It has helpers to help you seemlessly handle transactiosn in ssentezo wallet
 * 
 */
class Transaction
{
    /**
     * Type of transaction i.e Balance inquirely, Deposit or Withdrawal
     * @var string
     */
    protected $type;

    /**
     * The status of the stransaction 
     * @var string
     */
    protected $status;

    /**
     * External Reference. This is a unique identifier of your transaction
     * @var string 
     */
    protected $externalReference;

    /**
     * Create an instance of a ssentezo transacion 
     * @param string $externalReference
     */
    public function __construct($externalReference)
    {
        $this->externalReference = $externalReference;
    }
}
