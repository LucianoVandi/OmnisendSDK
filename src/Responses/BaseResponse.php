<?php

declare(strict_types=1);

namespace Lvandi\OmnisendSDK\Responses;

use stdClass;
use Psr\Http\Message\ResponseInterface;

abstract class BaseResponse
{
    protected ResponseInterface $response;

    /** @var array|stdClass */
    private $decodedBody;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;

        // 204 status code means empty response, then we set
        // the body to an empty array for custom response processing
        $this->decodedBody = 204 !== $response->getStatusCode()
            ? json_decode($response->getBody())
            : [];
    }

    public function getHttpResponse(): ResponseInterface
    {
        return $this->response;
    }

    public function getStatusCode(): int
    {
        return $this->getHttpResponse()->getStatusCode();
    }

    /**
     * @return array|mixed|stdClass
     */
    protected function getDecodedBody()
    {
        return $this->decodedBody;
    }
}
