#!/usr/bin/env php
<?php

require_once 'vendor/autoload.php';

use Lvandi\OmnisendSDK\ApiClient;
use Lvandi\OmnisendSDK\Types\Order;
use Lvandi\OmnisendSDK\HttpClients\GuzzleClientFactory;

$client = new ApiClient(
    new GuzzleClientFactory(
        (string) getenv('API_KEY')
    )
);

$order = Order::fromRawData([
    'orderID' => '1234',
    'email' => 'vandi.luciano@gmail.com',
    'orderNumber' => 1234,
    'cartID' => '1234',
    'shippingMethod' => 'Express',
    'trackingCode' => '987654321',
    'courierTitle' => 'GLS',
    'courierUrl' => 'https://gls.com/tracking',
    'orderUrl' => 'https://website.com/private/order/1234',
    'source' => 'website',
    'discountCode' => 'coupon_1234',
    'discountValue' => 500,
    'discountType' => Order::DISCOUNT_FIXED_AMOUNT,
    'currency' => 'EUR',
    'orderSum' => 5000,
    'subTotalSum',
    'subTotalTaxIncluded' => true,
    'discountSum' => 500,
    'shippingSum' => 400,
    'createdAt' => (new DateTimeImmutable())->format(DATE_ATOM),
    'paymentMethod' => 'Credit Card',
    'paymentStatus' => Order::PAYMENT_AWAITING,
    'fulfillmentStatus' => Order::ORDER_IN_PROGRESS,
    'shippingAddress' => [
        'firstName' => 'Paolo',
        'lastName' => 'Rossi',
        'country' => 'Italy',
        'countryCode' => 'IT',
        'city' => 'Cesena',
        'address' => 'via XX settembre 1',
        'postalCode' => '47433',
    ],
    'products' => [
        [
            'productID' => '12345',
            'variantID' => '12345',
            'sku' => '928382919192',
            'title' => 'Test Product',
            'vendor' => 'Test Brand',
            'quantity' => 1,
            'price' => 4600,
            'categoryIDs' => ['test_cat_1'],
        ],
    ],
]);

$response = $client->orders()->create($order);

if ($error = $client->getError()) {
    print_r($error);
    exit(2);
}

var_dump($response->getOrder());

if (function_exists('generateFixtureFromResponse')) {
    generateFixtureFromResponse(__FILE__, $response->getHttpResponse());
}

exit(1);
