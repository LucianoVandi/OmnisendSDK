#!/usr/bin/env php
<?php

require_once 'vendor/autoload.php';

use Lvandi\OmnisendSDK\Client;
use Lvandi\OmnisendSDK\Types\CartProduct;
use Lvandi\OmnisendSDK\HttpClients\GuzzleClientFactory;

$client = new Client(
    new GuzzleClientFactory(
        (string) getenv('API_KEY')
    )
);

$cartProduct = CartProduct::fromRawData([
    'cartProductID' => 'c_67890',
    'productID' => '6789',
    'variantID' => '6789',
    'title' => 'Test Product 2 Replaced',
    'quantity' => 2,
    'price' => 555,
    'currency' => 'EUR',
]);

$response = $client->getCartsApi()
    ->replaceProduct('1234', 'c_12345', $cartProduct);

if ($error = $client->getError()) {
    print_r($error);
    exit(2);
}

var_dump($response->getCartProductID());

if (function_exists('generateFixtureFromResponse')) {
    generateFixtureFromResponse(__FILE__, $response->getHttpResponse());
}

exit(1);
