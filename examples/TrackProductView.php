#!/usr/bin/env php
<?php

require_once 'vendor/autoload.php';

use Lvandi\OmnisendSDK\ApiClient;
use Lvandi\OmnisendSDK\Types\ProductView;

$callbacks = new stdClass();
$callbacks->onSuccess = 'function(){ console.log("success"); }';
$callbacks->onError = 'function(){ console.error("error"); }';

$productView = ProductView::fromArray([
    'productID' => '123',
    'variantID' => '123',
    'currency' => 'EUR',
    'price' => 123,
    'title' => 'Title',
    'imageUrl' => 'Image',
    'productUrl' => 'Product',
    'tags' => ['tag1', 'tag2'],
    'callbacks' => $callbacks,
]);

//$productView = new ProductView();
//$productView->setProductID('123');

$js = ApiClient::trackProductViewEvent($productView);

var_dump($js);

exit(1);
