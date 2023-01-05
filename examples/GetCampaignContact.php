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

$response = $client->getCampaignsApi()->getContact(
    '63b58492e18bb300184ffd8f',
    '63b353bfd5550d001ca1c6f1'
);

if ($error = $client->getError()) {
    print_r($error);
    exit(2);
}

var_dump($response);

if (function_exists('generateFixtureFromResponse')) {
    generateFixtureFromResponse(__FILE__, $response->getHttpResponse());
}

exit(1);
