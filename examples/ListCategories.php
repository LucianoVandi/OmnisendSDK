#!/usr/bin/env php
<?php

require_once 'vendor/autoload.php';

use Lvandi\OmnisendSDK\Client;
use Lvandi\OmnisendSDK\HttpClients\GuzzleClientFactory;

$client = new Client(
    new GuzzleClientFactory(
        getenv('API_KEY')
    )
);

$response = $client->getCategoriesApi()->list();

if ($error = $client->getError()) {
    print_r($error);
    exit(2);
}

var_dump($response->getCategories());

exit(1);
