<?php

namespace Lvandi\OmnisendSDK\Responses;

use Lvandi\OmnisendSDK\Types\Cart;
use Lvandi\OmnisendSDK\Types\Paging;
use Psr\Http\Message\ResponseInterface;

class CartListResponse extends BaseResponse
{
    /** @var array<Cart> */
    private array $carts = [];

    private Paging $paging;

    public function __construct(ResponseInterface $response)
    {
        parent::__construct($response);

        /** @var \stdClass $body */
        $body = $this->getDecodedBody();

        if (! empty($body->carts)) {
            foreach ($body->carts as $cart) {
                $this->carts[] = Cart::fromRawData($cart);
            }
        }

        $this->paging = new Paging($body->paging);
    }

    /**
     * @return array<Cart>
     */
    public function getCarts(): array
    {
        return $this->carts;
    }

    /**
     * @return Paging
     */
    public function getPaging(): Paging
    {
        return $this->paging;
    }
}
