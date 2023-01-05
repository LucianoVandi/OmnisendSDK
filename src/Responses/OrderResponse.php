<?php

namespace Lvandi\OmnisendSDK\Responses;

use Lvandi\OmnisendSDK\Types\Order;
use Psr\Http\Message\ResponseInterface;

class OrderResponse extends BaseResponse
{
    private Order $order;

    public function __construct(ResponseInterface $response)
    {
        parent::__construct($response);

        // 204 status code means empty response, then we set
        // the body to an empty array for custom response processing
        $body = $response->getStatusCode() !== 204
            ? json_decode($response->getBody())
            : [];

        $this->order = Order::fromRawData($body);
    }

    public function getOrder(): Order
    {
        return $this->order;
    }
}
