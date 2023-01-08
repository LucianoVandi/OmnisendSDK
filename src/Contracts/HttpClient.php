<?php

declare(strict_types=1);

namespace Lvandi\OmnisendSDK\Contracts;

use Psr\Http\Message\ResponseInterface;

/**
 * Abstract HTTP client interface
 */
interface HttpClient
{
    public function __construct(string $authToken, array $options);

    public function sendRequest(string $uri, string $method, ?array $options = null): ResponseInterface;

    public function getError(): array;

    public function getRateLimitRemaining(): int;
}
