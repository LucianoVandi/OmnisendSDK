<?php

namespace Lvandi\OmnisendSDK\HttpClients;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\ClientException;
use Lvandi\OmnisendSDK\Contracts\HttpClient;

/**
 * Concrete Guzzle HTTP client
 */
class GuzzleClient implements HttpClient
{
    private string $authToken;

    private Client $client;

    private array $error = [];

    private int $rateLimitRemaining;

    public function __construct(string $authToken, array $options)
    {
        $this->authToken = $authToken;
        $this->client = new Client($options);
    }

    /**
     * @param string $uri
     * @param string $method
     * @param array|null $options
     * @return ResponseInterface
     */
    public function sendRequest(string $uri, string $method, ?array $options = null): ResponseInterface
    {
        $this->resetError();

        if (! in_array($method, ['GET', 'POST', 'PUT', 'PATCH', 'DELETE'])) {
            throw new \InvalidArgumentException();
        }

        $requestOptions = [
            'headers' => [
                'X-API-KEY' => $this->authToken,
            ],
        ];

        if (! empty($options)) {
            $requestOptions = array_merge_recursive($options, $requestOptions);
        }

        try {
            $response = $this->client->request($method, $uri, $requestOptions);
            $this->setRateLimitRemaining((int)$response->getHeader('X-Rate-Limit-Remaining')[0]);

            return $response;
        } catch (ClientException $e) {
            $this->setError([
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ]);

            return $e->getResponse();
        }
    }

    /**
     * @return array
     */
    public function getError(): array
    {
        return $this->error;
    }

    /**
     * @param array $error
     * @return GuzzleClient
     */
    public function setError(array $error): GuzzleClient
    {
        $this->error = $error;

        return $this;
    }

    /**
     * @return int
     */
    public function getRateLimitRemaining(): int
    {
        return $this->rateLimitRemaining;
    }

    /**
     * @param int $rateLimitRemaining
     * @return GuzzleClient
     */
    public function setRateLimitRemaining(int $rateLimitRemaining): GuzzleClient
    {
        $this->rateLimitRemaining = $rateLimitRemaining;

        return $this;
    }

    /**
     * @return void
     */
    private function resetError()
    {
        $this->setError([]);
    }
}
