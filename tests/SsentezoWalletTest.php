<?php

namespace SsentezoWallet\Tests;

use SsentezoWallet\SentezoWallet;
use PHPUnit\Framework\TestCase;

class SsentezoWalletTest extends TestCase
{
    public function testCanInstantiateSsentezoWallet()
    {
        $ssentezoWallet = new SentezoWallet($this->username, $this->password);
        $this->assertInstanceOf(SentezoWallet::class, $ssentezoWallet);
    }
    public function testCanSetEnvironment()
    {
        $ssentezoWallet = new SentezoWallet($this->username, $this->password);
        $ssentezoWallet->setEnvironment("sandbox");
        $this->assertEquals("sandbox", $ssentezoWallet->getEnvironment());

        $ssentezoWallet->setEnvironment("production");
        $this->assertEquals("production", $ssentezoWallet->getEnvironment());
    }
}
