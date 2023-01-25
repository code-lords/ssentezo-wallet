<?php

namespace Codelords\SsentezoWallet;

use Exception;
use Codelords\SsentezoWallet\Traits\MobileNumber;

class SsentezoWallet extends Wallet
{
    use MobileNumber;
    /**
     * @var string
     * This is the username of the ssenteozo wallet api
     */
    protected $username;

    /**
     * @var string
     * This is the password of the ssentezo wallet api
     */
    protected $password;

    /**
     * The environment to use
     * @var string
     */
    protected $environment = "production";

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
    protected $payload;

    /**
     * The currency to use
     * @var string
     */
    protected $currency = "UGX";

    /**
     * The callback url to use
     * @var string
     */
    protected $callback = '';

    /**
     * Response
     * @var Response
     */
    public $response;

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

    /**
     * Checks the balance of the ssentezo wallet
     * @return Response The response object
     */
    function checkBalance()
    {
        $this->payload = [
            "username" => $this->username,
            "password" => $this->password,
            "currency" => $this->currency
        ];
        $this->setEndPoint($this->baseUrl . "acc_balance");
        $this->response = new Response($this->sendRequest());
        return $this->response;
    }

    /**
     * Withdraws money from the ssentezo wallet to the specified mobile money mobile number
     * @param string $msisdn The mobile money mobile number to withdraw to
     * @param float $amount The amount to withdraw
     * @param string $reason The reason for the withdrawal
     * @param string $externalReference The external reference for the withdrawal
     * @return Response;
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
        $this->response = new Response($response);
        return $this->response;
    }


    /**
     * Withdraws money from the ssentezo wallet to the specified mobile money mobile number
     * @param string $msisdn The mobile money mobile number to get monet from
     * @param float $amount The amount to withdraw
     * @param string $reason The reason for the withdrawal
     * @param string $externalReference The external reference for the withdrawal
     * @return Response
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
        $this->response = new Response($this->sendRequest());
        return $this->response;
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
     * Checks the status of a transaction in ssentezo wallet.
     * @param string $externalReference The external reference of the transaction
     * @return Response
     */
    public function checkStatus($externalReference)
    {


        $this->setEndPoint($this->baseUrl . "get_status/$externalReference");
        $this->response = new Response($this->sendRequest());
        return $this->response;
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


    public function setEnvironment($env)
    {
        $this->environment = $env;
    }
    public function getEnvironment()
    {
        return $this->environment;
    }
}
