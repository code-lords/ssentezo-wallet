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
     * Response constructor.
     * @param \Unirest\Response $res
     */
    public function __construct(\Unirest\Response $res)
    {
        $body = $res->body;
        $this->errorCode = $body->errorCode;
        $this->message = $body->message;
        $this->status = $body->status;
        $this->data = (array)$body->data;
    }
}
