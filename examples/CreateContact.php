#!/usr/bin/env php
<?php

require_once 'vendor/autoload.php';

use Lvandi\OmnisendSDK\Client;
use Lvandi\OmnisendSDK\DTO\Contact;
use Lvandi\OmnisendSDK\DTO\ChannelObject;
use Lvandi\OmnisendSDK\HttpClients\GuzzleClientFactory;

$client = new Client(
    new GuzzleClientFactory(
        getenv('API_KEY')
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

exit(1);
