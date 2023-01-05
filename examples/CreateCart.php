#!/usr/bin/env php
<?php

require_once 'vendor/autoload.php';

use Lvandi\OmnisendSDK\Client;
use Lvandi\OmnisendSDK\Types\Cart;
use Lvandi\OmnisendSDK\HttpClients\GuzzleClientFactory;

$client = new Client(
    new GuzzleClientFactory(
        (string) getenv('API_KEY')
    )
);

$cart = Cart::fromRawData([
    'cartID' => '1234',
    'email' => 'vandi.luciano@gmail.com',
    'currency' => 'EUR',
    'cartSum' => 1000,
    'cartRecoveryUrl' => 'https://mycart.com',
    'products' => [
        [
            'cartProductID' => 'c_1234',
            'productID' => '1234',
            'variantID' => '1234',
            'title' => 'Test Product',
            'quantity' => 1,
            'price' => 333,
        ],
    ],
]);

$response = $client->getCartsApi()->create($cart);

if ($error = $client->getError()) {
    print_r($error);
    exit(2);
}

var_dump($response->getCart());

if (function_exists('generateFixtureFromResponse')) {
    generateFixtureFromResponse(__FILE__, $response);
}

exit(1);
