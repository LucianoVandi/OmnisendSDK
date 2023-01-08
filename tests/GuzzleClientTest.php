<?php

declare(strict_types=1);

namespace Lvandi\OmnisendSDK\Tests;

use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Handler\MockHandler;
use Psr\Http\Message\ResponseInterface;
use Lvandi\OmnisendSDK\HttpClients\GuzzleClient;

class GuzzleClientTest extends TestCase
{
    public function testCanGetInstanceOfGuzzleClient(): void
    {
        $client = new GuzzleClient('myApiToken', []);
        $this->assertInstanceOf(GuzzleClient::class, $client);
    }

    public function testCanSendRequest(): void
    {
        $responseHeaders = [
            'X-Rate-Limit-Remaining' => 100,
        ];

        $mock = new MockHandler([
            new Response(200, $responseHeaders, ''),
        ]);

        $client = new GuzzleClient('apiKey', [
            'handler' => new HandlerStack($mock),
        ]);

        $request = $client->sendRequest('/', 'GET');

        $this->assertInstanceOf(ResponseInterface::class, $request);
    }

    public function testThrowsExceptionOnWrongMethod(): void
    {
        $responseHeaders = [
            'X-Rate-Limit-Remaining' => 100,
        ];

        $mock = new MockHandler([
            new Response(200, $responseHeaders, ''),
        ]);

        $client = new GuzzleClient('apiKey', [
            'handler' => new HandlerStack($mock),
        ]);

        $this->expectException(InvalidArgumentException::class);

        $client->sendRequest('/', 'WRONG');
    }
}
