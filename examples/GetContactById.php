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

$response = $client->getContactsApi()->get('63a0de5889048e001d91624b');

if ($error = $client->getError()) {
    print_r($error);
    exit(2);
}

var_dump($response->getContact());

if(function_exists('generateFixtureFromResponse')){
    generateFixtureFromResponse(__FILE__, $response);
}

exit(1);
