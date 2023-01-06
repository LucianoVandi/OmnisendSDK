#!/usr/bin/env php
<?php

require_once 'vendor/autoload.php';

use Lvandi\OmnisendSDK\Client;
use Lvandi\OmnisendSDK\Types\Product;
use Lvandi\OmnisendSDK\HttpClients\GuzzleClientFactory;

$client = new Client(
    new GuzzleClientFactory(
        (string) getenv('API_KEY')
    )
);

$product = Product::fromRawData([
    'productID' => '123',
    'title' => 'Test Product',
    'status' => Product::IN_STOCK,
    'currency' => 'EUR',
    'productUrl' => 'https://sorgentenatura.it/p/test-product-123',
    'variants' => [
        [
            'variantID' => '123_1',
            'title' => 'Red',
            'sku' => '9788488428111',
            'status' => Product::IN_STOCK,
            'price' => 1000,
        ],
    ],
]);

$response = $client->products()->create($product);

if ($error = $client->getError()) {
    print_r($error);
    exit(2);
}

print_r($response->getProduct());

if (function_exists('generateFixtureFromResponse')) {
    generateFixtureFromResponse(__FILE__, $response->getHttpResponse());
}

exit(1);
