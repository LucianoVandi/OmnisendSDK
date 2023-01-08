<?php

declare(strict_types=1);

namespace Lvandi\OmnisendSDK\Responses;

use Lvandi\OmnisendSDK\Types\Order;
use Psr\Http\Message\ResponseInterface;

class OrderResponse extends BaseResponse
{
    private Order $order;

    public function __construct(ResponseInterface $response)
    {
        parent::__construct($response);

        $body = $this->getDecodedBody();

        $this->order = Order::fromRawData($body);
    }

    public function getOrder(): Order
    {
        return $this->order;
    }
}
