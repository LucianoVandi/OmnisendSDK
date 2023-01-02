<?php

namespace Lvandi\OmnisendSDK;

use Lvandi\OmnisendSDK\Resources\Carts;
use Lvandi\OmnisendSDK\Resources\Events;
use Lvandi\OmnisendSDK\Resources\Orders;
use Lvandi\OmnisendSDK\Resources\Contacts;
use Lvandi\OmnisendSDK\Resources\Products;
use Lvandi\OmnisendSDK\Contracts\HttpClient;
use Lvandi\OmnisendSDK\Resources\Categories;
use Lvandi\OmnisendSDK\Contracts\HttpClientFactory;

class Client
{
    public const VERSION = '1.0';

    private HttpClient $httpClient;

    private string $baseUri = 'https://api.omnisend.com/v3/';

    private int $timeout = 20;

    public function __construct(HttpClientFactory $httpClientFactory, bool $debug = false)
    {
        $this->httpClient = $httpClientFactory->createClient([
            'base_uri' => $this->baseUri,
            'timeout' => $this->timeout,
            'debug' => $debug,
            'headers' => [
                'Accept' => 'application/json',
                'User-Agent' => 'eZeeDeskClient/'.self::VERSION,
            ],
        ]);
    }

    public function getEventsApi(): Events
    {
        return new Events($this->httpClient);
    }

    public function getContactsApi(): Contacts
    {
        return new Contacts($this->httpClient);
    }

    public function getProductsApi(): Products
    {
        return new Products($this->httpClient);
    }

    public function getCategoriesApi(): Categories
    {
        return new Categories($this->httpClient);
    }

    public function getCartsApi(): Carts
    {
        return new Carts($this->httpClient);
    }

    public function getOrdersApi(): Orders
    {
        return new Orders($this->httpClient);
    }

    public function getError(): array
    {
        return $this->httpClient->getError();
    }

    public function getRateLimitRemaining(): int
    {
        return $this->httpClient->getRateLimitRemaining();
    }
}
