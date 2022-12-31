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
$category->setTitle('Test Category 1 - Replaced');

$response = $client->getCategoriesApi()->replace('test_cat_1', $category);

if ($error = $client->getError()) {
    print_r($error);
    exit(2);
}

var_dump($response->getCategory());

exit(1);
