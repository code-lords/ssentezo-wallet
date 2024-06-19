<?php

namespace Codelords\SsentezoWallet\Response;


class PhoneNumberVerificationResponse extends Response
{

    public $phoneNumber;
    public $firstName;
    public $lastName;

    public function __construct(\Unirest\Response $res)
    {
        parent::__construct($res);
        $this->phoneNumber = $this->data["msisdn"] ?? "";
        $this->firstName = $this->data["FirstName"] ?? "";
        $this->lastName = $this->data['Surname'] ?? "";
    }
}
