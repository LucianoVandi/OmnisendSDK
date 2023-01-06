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

$response = $client->events()->list();

if ($error = $client->getError()) {
    print_r($error);
    exit(2);
}

foreach ($response->getEvents() as $event) {
    print_r($event);
}

if (function_exists('generateFixtureFromResponse')) {
    generateFixtureFromResponse(__FILE__, $response->getHttpResponse());
}

exit(1);
