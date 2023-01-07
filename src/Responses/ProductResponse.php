<?php

namespace Lvandi\OmnisendSDK\Responses;

use Lvandi\OmnisendSDK\Types\Product;
use Psr\Http\Message\ResponseInterface;

class ProductResponse extends BaseResponse
{
    private Product $product;

    public function __construct(ResponseInterface $response)
    {
        parent::__construct($response);

        $body = $this->getDecodedBody();

        $this->product = Product::fromRawData($body);
    }

    public function getProduct(): Product
    {
        return $this->product;
    }
}
