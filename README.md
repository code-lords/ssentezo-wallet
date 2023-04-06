# ssentezo-wallet

A package to help integrate ssentezo wallet into your php application

## Getting started

1. Create a ssentezo wallet account

[Ssentezo Wallet](https://wallet.ssentezo.com/)

## Installation

The recommended way to install ssentezo wallet is through [Composer](http://getcomposer.org):

```
$ composer require code-lords/ssentezo-wallet
```

After ssentezo wallet installs, you can copy an example file to the project root.

```
$ cp vendor/code-lords/ssentezo-wallet/resources/example.php .
```

## Making tranasactions

To make transactions you only need to create an instance of the ssentezo wallet

```php

use SsentezoWallet\SentezoWallet;

$username = "xxxxxxxxxxxxxxxxxxxxxxxxxxxxx";
$password = "zzzzzzzzzzzzzzzzzzzzzzzzzzzz";
$wallet = new SentezoWallet($username, $password);

```

With the wallet object you can easily check balance, make deposits withdrawals and as well check status of a transaction.

## Configurations

Before we look at how you can make transactions, Let's first look at the configurations.

```php
/**
 * Environment
 * You can choose which environment you are using your wallet.
 * There are two possibilites production and sandbox
 * For testing purposes always use sandbox to avoid making errors that may result int real
 * money losses.
 */
$wallet->setEnvironment("sandbox");


/**
 * Currency
 * You can also select a currency you want to use
 *
 */
$wallet->setCurrency("UGX");

```

Here is a list of all the possible configurations and the various methods you can use to manipulate them.

| Configuration | Description                                                              | Values              | Setter                 | Getter           |
| :------------ | :----------------------------------------------------------------------- | :------------------ | :--------------------- | :--------------- |
| Environment   | The enviroment you are using your wallet in                              | production, sandbox | setEnvironment($value) | getEnvironment() |
| Currency      | The currency                                                             | UGX, KES            | setCurrency($value)    | getCurrency()    |
| Callback      | A valid url which ssentezo wallet calls incase the transaction completes | A valid url         | setCallback($url)      | getCallback()    |
