<?php

namespace Lvandi\OmnisendSDK\Resources;

use Lvandi\OmnisendSDK\DTO\Order;
use Lvandi\OmnisendSDK\Responses\OrderResponse;

class Orders extends BaseResource
{
    private string $endpoint = 'orders';

    /**
     * Create a new Order
     * While posting new order email or/and phone or/and contactID must be provided.
     *
     * @param Order $order
     * @return OrderResponse
     */
    public function create(Order $order): OrderResponse
    {
        $response = $this->httpClient->sendRequest($this->endpoint, 'POST', [
            'body' => json_encode($order),
        ]);

        return new OrderResponse($response);
    }

    /**
     * Get order's info
     *
     * @param string $orderID
     * @return OrderResponse
     */
    public function get(string $orderID): OrderResponse
    {
        $uri = $this->endpoint .'/'. $orderID;

        $response = $this->httpClient->sendRequest($uri, 'GET');

        return new OrderResponse($response);
    }
}
