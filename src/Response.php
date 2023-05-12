<?php

namespace Codelords\SsentezoWallet;

/**
 * Class Response
 * @package SsentezoWallet
 */
class Response
{
    /**
     * @var string
     */
    public $message;
    /**
     * @var string
     */
    public $status;
    /**
     * @var string
     */
    public $errorCode;
    /**
     * @var array
     */
    public $data;

    /**
     * The external reference
     */
    public $externalReference;

    /**
     * The id of the request
     */
    public $request_id;

    /**
     * Transaction  status
     */
    public $transactionStatus;
    /**
     * Finacial transaction id
     */
    public $financialTransactionId;
    /**
     * Response constructor.
     * @param \Unirest\Response $res
     */
    public function __construct(\Unirest\Response $res)
    {
        $body = $res->body;
        $this->errorCode = ""; //$body->errorCode;
        $this->message = $body->message;
        $this->status = ""; //$body->status;
        $this->data = (array)$body->data;
        $this->externalReference = $this->data["externalReference"];
        $this->request_id = $this->data["request_id"];
        $this->transactionStatus = $this->data['transactionStatus'];
        $this->financialTransactionId = $this->data['financialTransactionId'] ?? "";
    }
}
