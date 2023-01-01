<?php

namespace Lvandi\OmnisendSDK\Tests;

use PHPUnit\Framework\TestCase;
use Lvandi\OmnisendSDK\Contracts\HttpClient;
use Lvandi\OmnisendSDK\Contracts\HttpClientFactory;
use Lvandi\OmnisendSDK\HttpClients\GuzzleClientFactory;

class GuzzleClientFactoryTest extends TestCase
{
    private GuzzleClientFactory $httpClientFactory;

    public function setUp(): void
    {
        parent::setUp();
        $this->httpClientFactory = new GuzzleClientFactory('myApiToken');
    }

    public function testCanGetInstanceOfHttpClientFactory()
    {
        $this->assertInstanceOf(HttpClientFactory::class, $this->httpClientFactory);
    }

    public function testCanGetInstanceOfHttpClient()
    {
        $httpClient = $this->httpClientFactory->createClient([]);
        $this->assertInstanceOf(HttpClient::class, $httpClient);
    }
}
