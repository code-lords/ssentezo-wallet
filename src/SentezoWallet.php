<?php

namespace SsentezoWallet;

use Exception;
use SsentezoWallet\Traits\MobileNumber;
use Unirest\Request;

class SentezoWallet
{
    use MobileNumber;
    /**
     * @var string
     * This is the username of the ssenteozo wallet api
     */
    private $username;

    /**
     * @var string
     * This is the password of the ssentezo wallet api
     */
    private $password;

    /**
     * The environment to use
     * @var string
     */
    private $environment = "production";

    /**
     * @var string
     * The base url of the ssentezo wallet api
     */
    protected $endPoint = "https://wallet.ssentezo.com/api/";

    /**
     * @var string
     * The base url of the ssentezo wallet api
     */
    protected $baseUrl = "https://wallet.ssentezo.com/api/";

    /**
     * The payload to send to the api
     * @var array
     */
    private $payload;

    /**
     * The currency to use
     * @var string
     */
    private $currency = "UGX";

    /**
     * The callback url to use
     * @var string
     */
    private $callback = '';

    /**
     * Instantiates a ssentezo wallet object which will be used to make real money transactions 
     * @param string $username The ssentezo wallet api username of the company
     * @param string $password The ssentezo wallet api password of the company 
     */
    function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    function checkBalance()
    {
        $this->payload = [
            "username" => $this->username,
            "password" => $this->password,
            "currency" => $this->currency
        ];
        $this->setEndPoint($this->baseUrl . "acc_balance");
        $response = $this->sendRequest();
        return $response;
    }

    /**
     * Withdraws money from the ssentezo wallet to the specified mobile money mobile number
     * @param string $msisdn The mobile money mobile number to withdraw to
     * @param float $amount The amount to withdraw
     * @param string $reason The reason for the withdrawal
     * @param string $externalReference The external reference for the withdrawal
     * @return \Unrest\Response;
     */
    public function withdraw($msisdn, $amount, $externalReference, $reason, $callback)
    {

        $this->payload = array(
            "msisdn" => $msisdn,
            "amount" => $amount,
            "reason" => $reason,
            "externalReference" => $externalReference,
            "callback" => $callback,
            "currency" => $this->currency,
            "environment" => $this->environment,
        );

        $this->setEndPoint($this->baseUrl . "withdraw");

        $response =  $this->sendRequest();

        return $response;
    }


    /**
     * Withdraws money from the ssentezo wallet to the specified mobile money mobile number
     * @param string $msisdn The mobile money mobile number to get monet from
     * @param float $amount The amount to withdraw
     * @param string $reason The reason for the withdrawal
     * @param string $externalReference The external reference for the withdrawal
     * @return array
     */
    public function deposit($msisdn, $amount, $externalReference, $reason, $callback)
    {
        $this->payload = array(
            "msisdn" => $this->formatMobileLocal($msisdn),
            "amount" => $amount,
            "reason" => $reason,
            "externalReference" => $externalReference,
            "callback" => $callback,
            "currency" => $this->currency,
            "environment" => $this->environment,
        );

        $this->setEndPoint($this->baseUrl . "deposit");
        $response =  $this->sendRequest();
        return $response;
    }

    /**
     * Sets the end point of the api
     * @param string $url A full url of the endpoint i.e https://wallet.ssentezo.com/api/deposit
     * 
     */
    public function setEndPoint($url)
    {
        $this->endPoint = $url;
    }


    /**
     * Returns the current end point of the api
     * @return string A full url of the current endpoint
     * 
     */
    public function getEndPoint()
    {
        return $this->endPoint;
    }

    private function sendRequest()
    {
        try {
            $headers = array('Content-Type: multipart/form-data');
            $body = $this->payload;
            Request::auth($this->username, $this->password);
            $response = Request::post($this->endPoint, $headers, $body);
        } catch (Exception $e) {
            print_r($e);
        }
        return $response;
    }
    public function setEnvironment($env)
    {
        $this->environment = $env;
    }
    public function getEnvironment()
    {
        return $this->environment;
    }
}
