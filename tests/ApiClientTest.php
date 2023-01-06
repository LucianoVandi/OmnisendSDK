<?php

namespace Lvandi\OmnisendSDK\Tests;

use Lvandi\OmnisendSDK\Client;
use PHPUnit\Framework\TestCase;
use Lvandi\OmnisendSDK\Resources\Events;
use Lvandi\OmnisendSDK\Resources\Contacts;
use Lvandi\OmnisendSDK\HttpClients\GuzzleClientFactory;

class ApiClientTest extends TestCase
{
    private Client $apiClient;

    public function setUp(): void
    {
        parent::setUp();
        $this->apiClient = new Client(new GuzzleClientFactory('myApiKey'));
    }

    public function testCanGetInstanceOfApiClient()
    {
        $this->assertInstanceOf(Client::class, $this->apiClient);
    }

    public function testCanGetInstanceOfEventsApi()
    {
        $eventsApi = $this->apiClient->events();
        $this->assertInstanceOf(Events::class, $eventsApi);
    }

    public function testCanGetInstanceOfContactsApi()
    {
        $contactsApi = $this->apiClient->contacts();
        $this->assertInstanceOf(Contacts::class, $contactsApi);
    }
}
