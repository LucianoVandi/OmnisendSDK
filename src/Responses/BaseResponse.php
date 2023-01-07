<?php

namespace Lvandi\OmnisendSDK\Responses;

use Psr\Http\Message\ResponseInterface;

abstract class BaseResponse
{
    protected ResponseInterface $response;

    /** @var array|\stdClass */
    private $decodedBody;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;

        // 204 status code means empty response, then we set
        // the body to an empty array for custom response processing
        $this->decodedBody = $response->getStatusCode() !== 204
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
     * @return array|mixed|\stdClass
     */
    protected function getDecodedBody()
    {
        return $this->decodedBody;
    }
}
