<?php

namespace Lvandi\OmnisendSDK\Responses;

use Lvandi\OmnisendSDK\Types\Order;
use Lvandi\OmnisendSDK\Types\Paging;
use Psr\Http\Message\ResponseInterface;

class OrderListResponse extends BaseResponse
{
    /** @var array<Order> */
    private array $orders = [];

    private Paging $paging;

    public function __construct(ResponseInterface $response)
    {
        parent::__construct($response);

        /** @var \stdClass $body */
        $body = json_decode($response->getBody());

        if (! empty($body->orders)) {
            foreach ($body->orders as $order) {
                $this->orders[] = Order::fromRawData($order);
            }
        }

        $this->paging = new Paging($body->paging);
    }

    /**
     * @return array<Order>
     */
    public function getOrders(): array
    {
        return $this->orders;
    }

    /**
     * @return Paging
     */
    public function getPaging(): Paging
    {
        return $this->paging;
    }
}
