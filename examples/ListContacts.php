#!/usr/bin/env php
<?php

require_once 'vendor/autoload.php';

use Lvandi\OmnisendSDK\Client;
use Lvandi\OmnisendSDK\HttpClients\GuzzleClientFactory;

$client = new Client(
    new GuzzleClientFactory(
        getenv('API_KEY')
    )
);

$response = $client->getContactsApi()->list([
    'status' => \Lvandi\OmnisendSDK\DTO\ChannelObject::STATUS_UNSUBSCRIBED,
//    'email' => 'vandi.luciano@gmail.com'
]);

if ($error = $client->getError()) {
    print_r($error);
    exit(2);
}

var_dump($response->getContacts());

exit(1);
