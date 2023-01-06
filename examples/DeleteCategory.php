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

$response = $client->categories()->delete('test_cat_1');

if ($error = $client->getError()) {
    print_r($error);
    exit(2);
}

var_dump($response->getCategory());

exit(1);
