#!/usr/bin/env php
<?php

require_once 'vendor/autoload.php';

use Lvandi\OmnisendSDK\Client;
use Lvandi\OmnisendSDK\Types\Order;
use Lvandi\OmnisendSDK\HttpClients\GuzzleClientFactory;

$client = new Client(
    new GuzzleClientFactory(
        (string) getenv('API_KEY')
    )
);

$order = Order::fromRawData([
    'paymentStatus' => Order::PAYMENT_PAID,
    'fulfillmentStatus' => Order::ORDER_FULFILLED,
]);

$response = $client->orders()->updateStatus('1234', $order);

if ($error = $client->getError()) {
    print_r($error);
    exit(2);
}

var_dump($response->getOrder());

if (function_exists('generateFixtureFromResponse')) {
    generateFixtureFromResponse(__FILE__, $response->getHttpResponse());
}

exit(1);
