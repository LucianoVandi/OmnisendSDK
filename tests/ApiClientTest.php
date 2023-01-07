<?php

namespace Lvandi\OmnisendSDK\Tests;

use PHPUnit\Framework\TestCase;
use Lvandi\OmnisendSDK\ApiClient;
use Lvandi\OmnisendSDK\Resources\Carts;
use Lvandi\OmnisendSDK\Resources\Events;
use Lvandi\OmnisendSDK\Resources\Orders;
use Lvandi\OmnisendSDK\Resources\Contacts;
use Lvandi\OmnisendSDK\Resources\Products;
use Lvandi\OmnisendSDK\Resources\Campaigns;
use Lvandi\OmnisendSDK\Contracts\HttpClient;
use Lvandi\OmnisendSDK\Resources\Categories;
use Lvandi\OmnisendSDK\Contracts\HttpClientFactory;
use Lvandi\OmnisendSDK\HttpClients\GuzzleClientFactory;

class ApiClientTest extends TestCase
{
    private ApiClient $apiClient;

    public function setUp(): void
    {
        parent::setUp();
        $this->apiClient = new ApiClient(new GuzzleClientFactory('myApiKey'));
    }

    public function testCanGetInstanceOfApiClient(): void
    {
        $this->assertInstanceOf(ApiClient::class, $this->apiClient);
    }

    public function testCanGetInstanceOfEventsApi(): void
    {
        $eventsApi = $this->apiClient->events();
        $this->assertInstanceOf(Events::class, $eventsApi);
    }

    public function testCanGetInstanceOfContactsApi(): void
    {
        $contactsApi = $this->apiClient->contacts();
        $this->assertInstanceOf(Contacts::class, $contactsApi);
    }

    public function testCanGetInstanceOfCartsApi(): void
    {
        $cartsApi = $this->apiClient->carts();
        $this->assertInstanceOf(Carts::class, $cartsApi);
    }

    public function testCanGetInstanceOfOrdersApi(): void
    {
        $ordersApi = $this->apiClient->orders();
        $this->assertInstanceOf(Orders::class, $ordersApi);
    }

    public function testCanGetInstanceOfCampaignsApi(): void
    {
        $campaignsApi = $this->apiClient->campaigns();
        $this->assertInstanceOf(Campaigns::class, $campaignsApi);
    }

    public function testCanGetInstanceOfCategoriesApi(): void
    {
        $categoriesApi = $this->apiClient->categories();
        $this->assertInstanceOf(Categories::class, $categoriesApi);
    }

    public function testCanGetInstanceOfProductsApi(): void
    {
        $productsApi = $this->apiClient->products();
        $this->assertInstanceOf(Products::class, $productsApi);
    }

    public function testCanGetErrors(): void
    {
        $httpClient = $this->createMock(HttpClient::class);
        $httpClient->method('getError')
            ->willReturn([
                'message' => 'Error message',
                'code' => 400,
            ]);

        $httpClientFactory = $this->createMock(HttpClientFactory::class);
        $httpClientFactory->method('createClient')
            ->willReturn($httpClient);

        $error = (new ApiClient($httpClientFactory))->getError();

        $this->assertIsArray($error);
        $this->assertArrayHasKey('message', $error);
        $this->assertArrayHasKey('code', $error);
    }

    public function testCanGetSnippetWithPageView(): void
    {
        $accountID = 'myAccountId';
        $snippet = $this->apiClient->getSnippet($accountID);
        $this->assertEquals($this->getSnippetFixture($accountID), $snippet);
    }

    public function testCanGetSnippetWithoutPageView(): void
    {
        $accountID = 'myAccountId';
        $snippet = $this->apiClient->getSnippet($accountID, false);
        $this->assertEquals($this->getSnippetFixture($accountID, false), $snippet);
    }

    private function getSnippetFixture(string $accountID, bool $trackPageView = true): string
    {
        $fileName = $trackPageView ? 'with-pageview' : 'without-pageview';
        $snippet = (string) file_get_contents('./tests/fixtures/js-snippet/'.$fileName);

        return trim(str_replace('{ACCOUNT_ID}', $accountID, $snippet));
    }
}
