<?php

namespace Lvandi\OmnisendSDK\HttpClients;

use Lvandi\OmnisendSDK\Contracts\HttpClientFactory;

/**
 * Guzzle HTTP client factory
 */
class GuzzleClientFactory implements HttpClientFactory
{
    private string $authToken;

    public function __construct(string $authToken)
    {
        $this->authToken = $authToken;
    }

    public function createClient(array $options): GuzzleClient
    {
        return new GuzzleClient($this->authToken, $options);
    }
}
