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

$response = $client->getCampaignsApi()->list();

if ($error = $client->getError()) {
    print_r($error);
    exit(2);
}

var_dump($response->getCampaigns());

if (function_exists('generateFixtureFromResponse')) {
    generateFixtureFromResponse(__FILE__, $response);
}

exit(1);