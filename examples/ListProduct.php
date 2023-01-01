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

$response = $client->getProductsApi()->list([
    'vendor' => 'Probios',
], 10);

if ($error = $client->getError()) {
    print_r($error);
    exit(2);
}

print_r($response->getProducts());

exit(1);
