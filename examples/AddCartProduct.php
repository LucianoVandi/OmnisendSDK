#!/usr/bin/env php
<?php

require_once 'vendor/autoload.php';

use Lvandi\OmnisendSDK\Client;
use Lvandi\OmnisendSDK\DTO\CartProduct;
use Lvandi\OmnisendSDK\HttpClients\GuzzleClientFactory;

$client = new Client(
    new GuzzleClientFactory(
        (string) getenv('API_KEY')
    )
);

$cartProduct = CartProduct::fromRawData([
    'cartProductID' => 'c_12345',
    'productID' => '12345',
    'variantID' => '12345',
    'title' => 'Test Product 2',
    'quantity' => 10,
    'price' => 444,
    'currency' => 'EUR',
]);

$response = $client->getCartsApi()->addProduct('1234', $cartProduct);

if ($error = $client->getError()) {
    print_r($error);
    exit(2);
}

var_dump($response->getCartProductID());

if (function_exists('generateFixtureFromResponse')) {
    generateFixtureFromResponse(__FILE__, $response);
}

exit(1);
