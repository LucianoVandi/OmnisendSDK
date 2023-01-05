#!/usr/bin/env php
<?php

require_once 'vendor/autoload.php';

use Lvandi\OmnisendSDK\Client;
use Lvandi\OmnisendSDK\Types\Contact;
use Lvandi\OmnisendSDK\Types\ChannelObject;
use Lvandi\OmnisendSDK\HttpClients\GuzzleClientFactory;

$client = new Client(
    new GuzzleClientFactory(
        (string) getenv('API_KEY')
    )
);

$contact = Contact::fromRawData([
    'identifiers' => [
        [
            'id' => 'vandi.luciano@gmail.com',
            'type' => 'email',
            'channels' => [
                'email' => [
                    'status' => ChannelObject::STATUS_NONSUBSCRIBED,
                ],
            ],
        ],
    ],
    'tags' => null,
]);

$response = $client->getContactsApi()->create($contact);

if ($error = $client->getError()) {
    print_r($error);
    exit(2);
}

print_r($response->getContact());

if (function_exists('generateFixtureFromResponse')) {
    generateFixtureFromResponse(__FILE__, $response->getHttpResponse());
}

exit(1);
