<?php

namespace Lvandi\OmnisendSDK;

use Lvandi\OmnisendSDK\Resources\Carts;
use Lvandi\OmnisendSDK\Resources\Events;
use Lvandi\OmnisendSDK\Resources\Orders;
use Lvandi\OmnisendSDK\Types\ProductView;
use Lvandi\OmnisendSDK\Resources\Contacts;
use Lvandi\OmnisendSDK\Resources\Products;
use Lvandi\OmnisendSDK\Resources\Campaigns;
use Lvandi\OmnisendSDK\Contracts\HttpClient;
use Lvandi\OmnisendSDK\Resources\Categories;
use Lvandi\OmnisendSDK\Contracts\HttpClientFactory;

class ApiClient
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
                'User-Agent' => 'OmnisendSDK/'.self::VERSION,
            ],
        ]);
    }

    public function events(): Events
    {
        return new Events($this->httpClient);
    }

    public function contacts(): Contacts
    {
        return new Contacts($this->httpClient);
    }

    public function products(): Products
    {
        return new Products($this->httpClient);
    }

    public function categories(): Categories
    {
        return new Categories($this->httpClient);
    }

    public function carts(): Carts
    {
        return new Carts($this->httpClient);
    }

    public function orders(): Orders
    {
        return new Orders($this->httpClient);
    }

    public function campaigns(): Campaigns
    {
        return new Campaigns($this->httpClient);
    }

    public function getError(): array
    {
        return $this->httpClient->getError();
    }

    public function getRateLimitRemaining(): int
    {
        return $this->httpClient->getRateLimitRemaining();
    }

    public static function getSnippet(string $accountID, bool $trackPageview = true): string
    {
        $snippet = [
            '<script type="text/javascript">',
            'window.omnisend = window.omnisend || [];',
            'omnisend.push(["accountID", "'.$accountID.'"]);',
            $trackPageview ? 'omnisend.push(["track", "$pageViewed"]);' : '',
            '!function(){var e=document.createElement("script");',
            'e.type="text/javascript",e.async=!0,e.src="https://omnisnippet1.com/inshop/launcher-v2.js";',
            'var t=document.getElementsByTagName("script")[0];',
            't.parentNode.insertBefore(e,t)}();',
            '</script>',
        ];

        return implode('', $snippet);
    }

    public static function trackProductViewEvent(ProductView $productView): string
    {
        $snippet = [
            '<script type="text/javascript">',
                'omnisend.push(["track", "$productViewed", '.$productView->toJsObject().'])',
            '</script>',
        ];

        return implode('', $snippet);
    }
}
