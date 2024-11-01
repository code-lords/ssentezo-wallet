<?php

namespace Codelords\SsentezoWallet;

use Codelords\SsentezoWallet\Response\AccountBalanceResponse;
use Codelords\SsentezoWallet\Response\BankListResponse;
use Codelords\SsentezoWallet\Response\DepositResponse;
use Codelords\SsentezoWallet\Response\PhoneNumberVerificationResponse;
use Codelords\SsentezoWallet\Response\TransactionStatusResponse;
use Codelords\SsentezoWallet\Response\WithdrawalResponse;
use Exception;
use Codelords\SsentezoWallet\Traits\MobileNumber;
use Unirest\Request;
use Codelords\SsentezoWallet\Response;
use Codelords\SsentezoWallet\Response\PushToBankResponse;
use Codelords\SsentezoWallet\Response\PushToBankStatusResponse;

class SsentezoWallet
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
     * Gets the legal registration names of the phone number
     * @return PhoneNumberVerificationResponse The response object
     */
    function verifyPhoneNumber($phone_number): PhoneNumberVerificationResponse
    {
        $this->payload = [
            "msisdn" => $phone_number
        ];
        $this->setEndPoint($this->baseUrl . "msisdn-verification");
        $this->response = new PhoneNumberVerificationResponse($this->sendRequest());
        return $this->response;
    }

    /**
     * Checks the balance of the ssentezo wallet
     * @return AccountBalanceResponse The response object
     */
    function checkBalance(): AccountBalanceResponse
    {
        $this->payload = [
            "username" => $this->username,
            "password" => $this->password,
            "currency" => $this->currency
        ];
        $this->setEndPoint($this->baseUrl . "acc_balance");
        $this->response = new AccountBalanceResponse($this->sendRequest());
        return $this->response;
    }

    /**
     * Withdraws money from the ssentezo wallet to the specified mobile money mobile number
     * @param string $msisdn The mobile money mobile number to withdraw to
     * @param float $amount The amount to withdraw
     * @param string $reason The reason for the withdrawal
     * @param string $externalReference The external reference for the withdrawal
     * @return WithdrawalResponse;
     */
    public function withdraw($msisdn, $amount, $externalReference, $reason, $name = "", $success_callback = "", $failure_callback = ""): WithdrawalResponse
    {

        $this->payload = array(
            "msisdn" => $msisdn,
            "amount" => $amount,
            "reason" => $reason,
            "externalReference" => $externalReference,
            "currency" => $this->currency,

            'name' => $name,
            'success_callback' => $success_callback,
            'failure_callback' => $failure_callback,
        );

        $this->setEndPoint($this->baseUrl . "withdraw");

        $response =  $this->sendRequest();
        $this->response = new WithdrawalResponse($response);
        return $this->response;
    }


    /**
     * Deposits to the ssentezo wallet account from the specified mobile money
     * @param string $msisdn The mobile money mobile number to get monet from
     * @param float $amount The amount to withdraw
     * @param string $reason The reason for the withdrawal
     * @param string $externalReference The external reference for the withdrawal
     * @return DepositResponse
     */
    public function deposit($msisdn, $amount, $externalReference, $reason,  $name = "", $success_callback = "", $failure_callback = ""): DepositResponse
    {
        $this->payload = array(
            "msisdn" => $this->formatMobileLocal($msisdn),
            "amount" => $amount,
            "reason" => $reason,
            "externalReference" => $externalReference,

            "currency" => $this->currency,

            'name' => $name,
            'success_callback' => $success_callback,
            'failure_callback' => $failure_callback,

        );

        $this->setEndPoint($this->baseUrl . "deposit");
        $this->response = new DepositResponse($this->sendRequest());
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
     * @return TransactionStatusResponse
     */
    public function checkStatus($externalReference): TransactionStatusResponse
    {


        $this->setEndPoint($this->baseUrl . "get_status/$externalReference");
        $this->response = new TransactionStatusResponse($this->sendRequest());
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
    protected function sendRequest()
    {
        try {
            $headers = array('Content-Type: multipart/form-data');
            $body = $this->payload;
            Request::auth($this->username, $this->password);
            $response = Request::post($this->endPoint, $headers, $body);
        } catch (Exception $e) {
            print_r($e);
        }
        // print_r($response);
        return $response;
    }

    /**
     * Get a list of available banks to transfer
     * @return BankListResponse
     */
    public function getAvailableBanks()
    {


        $this->setEndPoint($this->baseUrl . "push-to-bank/get-banks");
        $this->response = new BankListResponse($this->sendRequest());
        return $this->response;
    }



    /**
     * Request to push money from ssentezo wallet to a bank account 
     * @param mixed $bank_id
     * @param mixed $account_name
     * @param mixed $account_number
     * @param mixed $amount
     * @return \Codelords\SsentezoWallet\Response\PushToBankResponse
     */
    public function requestBankTransfer($bank_id, $account_name, $account_number, $amount, $external_ref, $reason=""): PushToBankResponse
    {
        $this->payload = array(
            'external_reference' => $external_ref,
            'bank_id' => $bank_id, // The id of one of the banks that we support. It's obtained from the get-banks endpoint
            'account_name' => $account_name, // The name of the bank account you would like the funds to be transfered to
            'account_number' => $account_number, // The bank account number you would like the funds to be transfered to
            'amount' => $amount, // The amount of money you would like to transfer. Minimum amount is UGX 50,000
            'reason'=>$reason
        );

        $this->setEndPoint($this->baseUrl . "push-to-bank/request-bank-transfer");
        $this->response = new PushToBankResponse($this->sendRequest());
        return $this->response;
    }

    /**
     * Checks the status of a transaction in ssentezo wallet.
     * @param string $externalReference The external reference of the transaction
     * @return TransactionStatusResponse
     */
    public function checkPushToBankStatus($externalReference): PushToBankStatusResponse
    {


        $this->payload = array(
            'external_reference' => $externalReference
        );
        $this->setEndPoint($this->baseUrl . "push-to-bank/check-bank-transfer-status");
        $this->response = new PushToBankStatusResponse($this->sendRequest());
        return $this->response;
    }
}
