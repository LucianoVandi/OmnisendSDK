<?php

namespace Lvandi\OmnisendSDK\Contracts;

/**
 * Abstract HTTP client factory interface
 */
interface HttpClientFactory
{
    public function __construct(string $authToken);

    public function createClient(array $options): HttpClient;
}
