#!/usr/bin/env php
<?php

require_once 'vendor/autoload.php';

use Lvandi\OmnisendSDK\Client;
use Lvandi\OmnisendSDK\DTO\Category;
use Lvandi\OmnisendSDK\HttpClients\GuzzleClientFactory;

$client = new Client(
    new GuzzleClientFactory(
        getenv('API_KEY')
    )
);

$category = new Category();
$category->setCategoryID('test_cat_1')
    ->setTitle('Test Category 1')
    ->setCreatedAt((new DateTimeImmutable())->format(DATE_ATOM));

$response = $client->getCategoriesApi()->create($category);

if ($error = $client->getError()) {
    print_r($error);
    exit(2);
}

var_dump($response->getCategory());

exit(1);
