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

$response = $client->getCampaignsApi()->get('63b58492e18bb300184ffd8f');

if ($error = $client->getError()) {
    print_r($error);
    exit(2);
}

var_dump($response->getCampaign());

if (function_exists('generateFixtureFromResponse')) {
    generateFixtureFromResponse(__FILE__, $response);
}

exit(1);
