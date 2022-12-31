<?php

namespace Lvandi\OmnisendSDK\Responses;

use Lvandi\OmnisendSDK\DTO\Cart;
use Psr\Http\Message\ResponseInterface;

class CartResponse extends BaseResponse
{
    private Cart $cart;

    public function __construct(ResponseInterface $response)
    {
        parent::__construct($response);

        // 204 status code means empty response, then we set
        // the body to an empty array for custom response processing
        $body = $response->getStatusCode() !== 204
            ? json_decode($response->getBody())
            : [];

        $this->cart = Cart::fromRawData($body);
    }

    public function getCart(): Cart
    {
        return $this->cart;
    }
}
