<?php

namespace Lvandi\OmnisendSDK\Responses;

use Lvandi\OmnisendSDK\DTO\Product;
use Psr\Http\Message\ResponseInterface;

class ProductResponse extends BaseResponse
{
    private Product $product;

    public function __construct(ResponseInterface $response)
    {
        parent::__construct($response);

        // 204 status code means empty response, then we set
        // the body to an empty array for custom response processing
        $body = $response->getStatusCode() !== 204
            ? json_decode($response->getBody())
            : [];

        $this->product = Product::fromRawData($body);
    }

    public function getProduct(): Product
    {
        return $this->product;
    }
}
