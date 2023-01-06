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

$response = $client->events()->get('639f232ae32347001e1d36c2');

if ($error = $client->getError()) {
    print_r($error);
    exit(2);
}

print_r($response->getEvent());

if (function_exists('generateFixtureFromResponse')) {
    generateFixtureFromResponse(__FILE__, $response->getHttpResponse());
}

exit(1);
