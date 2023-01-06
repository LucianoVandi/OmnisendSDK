#!/usr/bin/env php
<?php

require_once 'vendor/autoload.php';

use Lvandi\OmnisendSDK\ApiClient;
use Lvandi\OmnisendSDK\HttpClients\GuzzleClientFactory;

$client = new ApiClient(
    new GuzzleClientFactory(
        (string) getenv('API_KEY')
    )
);

$response = $client->campaigns()->list();

if ($error = $client->getError()) {
    print_r($error);
    exit(2);
}

var_dump($response->getCampaigns());

if (function_exists('generateFixtureFromResponse')) {
    generateFixtureFromResponse(__FILE__, $response->getHttpResponse());
}

exit(1);
