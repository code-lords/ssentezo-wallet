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
    public $message = "";
    /**
     * @var string
     */
    public $status = "";
    /**
     * @var string
     */
    public $errorCode = "";
    /**
     * @var array
     */
    public $data = [];

    /**
     * The external reference
     */
    public $externalReference = "";

    /**
     * The id of the request
     */
    public $request_id = "";

    /**
     * Transaction  status
     */
    public $transactionStatus = "";
    /**
     * Finacial transaction id
     */
    public $financialTransactionId = "";
    /**
     * Response constructor.
     * @param \Unirest\Response $res
     */
    public function __construct(\Unirest\Response $res)
    {
        $body = $res->body;
        if (property_exists($body, 'errorCode')) {
            $this->errorCode = $body->errorCode;
        }

        if (property_exists($body, 'message')) {
            $this->message = $body->message;
        }

        if (property_exists($body, 'status')) {
            $this->status = $body->status;
        }
        if (property_exists($body, 'data')) {
            $this->data = (array)$body->data;
            $this->externalReference = $this->data["externalReference"] ?? "";
            $this->request_id = $this->data["request_id"] ?? "";
            $this->transactionStatus = $this->data['transactionStatus'] ?? "";
            $this->financialTransactionId = $this->data['financialTransactionId'] ?? "";
        }
    }
}
