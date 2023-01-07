<?php

namespace Lvandi\OmnisendSDK\Responses;

use Lvandi\OmnisendSDK\Types\Cart;
use Psr\Http\Message\ResponseInterface;

class CartResponse extends BaseResponse
{
    private Cart $cart;

    public function __construct(ResponseInterface $response)
    {
        parent::__construct($response);

        $body = $this->getDecodedBody();

        $this->cart = Cart::fromRawData($body);
    }

    public function getCart(): Cart
    {
        return $this->cart;
    }
}
