<?php

namespace Codelords\SsentezoWallet\Response;

/**
 * Class Response
 * @package SsentezoWallet
 */
class Response
{

    public $response = "";

    public $error = [];
    public $errorMessage = '';

    public $errors;

    public $errorCode;

    /**
     * @var array
     */
    public $data = [];

    /**
     * The external reference
     */
    // public $externalReference = "";

    /**
     * The id of the request
     */
    // public $request_id = "";

    /**
     * Transaction  status
     */
    // public $transactionStatus = "";
    /**
     * Finacial transaction id
     */
    // public $financialTransactionId = "";
    /**
     * Response constructor.
     * @param \Unirest\Response $res
     */
    public function __construct(\Unirest\Response $res)
    {
        $body = $res->body;
        if (property_exists($body, 'response')) {
            $this->response = $body->response;
        }
        if (property_exists($body, 'error')) {
            $this->error = (array)$body->error;
            $this->errorMessage = $this->error['message'];
            $this->errorCode = $this->error['code'] ?? '';
            $this->errors = $this->error['errors'] ?? [];
        }

        if (property_exists($body, 'data')) {
            $this->data = (array)$body->data;
            // $this->externalReference = $this->data["externalReference"] ?? "";
            // $this->request_id = $this->data["request_id"] ?? "";
            // $this->transactionStatus = $this->data['transactionStatus'] ?? "";
            // $this->financialTransactionId = $this->data['financialTransactionId'] ?? "";
        }
    }
}
