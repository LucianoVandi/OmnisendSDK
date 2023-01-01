<?php

namespace Lvandi\OmnisendSDK\Responses;

use Psr\Http\Message\ResponseInterface;

abstract class BaseResponse
{
    protected ResponseInterface $response;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    public function getHttpResponse(): ResponseInterface
    {
        return $this->response;
    }

    public function getStatusCode(): int
    {
        return $this->getHttpResponse()->getStatusCode();
    }
}
