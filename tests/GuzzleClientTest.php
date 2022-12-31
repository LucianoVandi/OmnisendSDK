<?php

namespace Lvandi\OmnisendSDK\Tests;

use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Handler\MockHandler;
use Psr\Http\Message\ResponseInterface;
use Lvandi\OmnisendSDK\HttpClients\GuzzleClient;

class GuzzleClientTest extends TestCase
{
    public function testCanGetInstanceOfGuzzleClient()
    {
        $client = new GuzzleClient('myApiToken', []);
        $this->assertInstanceOf(GuzzleClient::class, $client);
    }

    public function testCanSendRequest()
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

    public function testThrowsExceptionOnWrongMethod()
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

        $this->expectException(\InvalidArgumentException::class);

        $client->sendRequest('/', 'WRONG');
    }
}
