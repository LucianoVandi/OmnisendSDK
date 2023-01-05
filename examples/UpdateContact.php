#!/usr/bin/env php
<?php

require_once 'vendor/autoload.php';

use Lvandi\OmnisendSDK\Client;
use Lvandi\OmnisendSDK\Types\Contact;
use Lvandi\OmnisendSDK\HttpClients\GuzzleClientFactory;

$client = new Client(
    new GuzzleClientFactory(
        (string) getenv('API_KEY')
    )
);

$contact = Contact::fromRawData([
    'firstName' => 'Luciano',
    'tags' => ['updated'],
]);

$response = $client->getContactsApi()->update($contact, null, '63a0de5889048e001d91624b');

if ($error = $client->getError()) {
    print_r($error);
    exit(2);
}

print_r($response->getContact());

if (function_exists('generateFixtureFromResponse')) {
    generateFixtureFromResponse(__FILE__, $response->getHttpResponse());
}

exit(1);
