<?php

namespace Codelords\SsentezoWallet\Response;


class BankListResponse extends Response
{

    public $banks = [];


    public function __construct(\Unirest\Response $res)
    {
        parent::__construct($res);

        $this->banks = $this->data['banks'] ?? [];
    }
}
