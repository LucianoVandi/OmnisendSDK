#!/usr/bin/env php
<?php

require_once 'vendor/autoload.php';

use Lvandi\OmnisendSDK\Client;
use Lvandi\OmnisendSDK\DTO\Order;
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

$response = $client->getOrdersApi()->updateStatus('1234', $order);

if ($error = $client->getError()) {
    print_r($error);
    exit(2);
}

var_dump($response->getOrder());

if(function_exists('generateFixtureFromResponse')){
    generateFixtureFromResponse(__FILE__, $response);
}

exit(1);
