#!/usr/bin/env php
<?php

require_once 'vendor/autoload.php';

use Lvandi\OmnisendSDK\Client;
use Lvandi\OmnisendSDK\HttpClients\GuzzleClientFactory;

$client = new Client(
    new GuzzleClientFactory(
        (string) getenv('API_KEY')
    )
);

$response = $client->getCartsApi()->removeProduct('1234', 'c_12345');

if ($error = $client->getError()) {
    print_r($error);
    exit(2);
}

var_dump($response);

exit(1);
