<?php

namespace Lvandi\OmnisendSDK\Resources;

use Lvandi\OmnisendSDK\DTO\Order;
use Lvandi\OmnisendSDK\Responses\OrderResponse;
use Lvandi\OmnisendSDK\Responses\OrderListResponse;

class Orders extends BaseResource
{
    private string $endpoint = 'orders';

    protected array $listFilters = [
        'email',
        'phone',
        'contactID',
        'cartID',
        'segmentID',
        'dateFrom',
        'dateTo',
        'updatedFrom',
        'updatedTo',
        'paymentStatus',
        'fulfillmentStatus',
    ];

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

    /**
     * Replace existing order.
     * All stored order data will be overwritten with request data.
     * If data is missing from request will be deleted from order.
     * This method used to replace order with all its data.
     *
     * @param string $orderID
     * @param Order $order
     * @return OrderResponse
     */
    public function replace(string $orderID, Order $order): OrderResponse
    {
        $uri = $this->endpoint .'/'. $orderID;

        $response = $this->httpClient->sendRequest($uri, 'PUT', [
            'body' => json_encode($order),
        ]);

        return new OrderResponse($response);
    }

    /**
     * Update order's status
     *
     * @param string $orderID
     * @param Order $order
     * @return OrderResponse
     */
    public function updateStatus(string $orderID, Order $order): OrderResponse
    {
        $uri = $this->endpoint .'/'. $orderID;

        $response = $this->httpClient->sendRequest($uri, 'PATCH', [
            'body' => json_encode($order),
        ]);

        return new OrderResponse($response);
    }

    /**
     * Delete order
     *
     * @param string $orderID
     * @return OrderResponse
     */
    public function delete(string $orderID): OrderResponse
    {
        $uri = $this->endpoint .'/'. $orderID;

        $response = $this->httpClient->sendRequest($uri, 'DELETE');

        return new OrderResponse($response);
    }

    /**
     * List orders
     *
     * @param array|null $filters
     * @param int|null $limit
     * @param int|null $offset
     * @param string|null $sort
     * @return OrderListResponse
     * @throws \Exception
     */
    public function list(
        ?array $filters = null,
        ?int $limit = 100,
        ?int $offset = 0,
        ?string $sort = 'createdAt'
    ): OrderListResponse {
        $queryParams = [
            'limit' => $limit,
            'offset' => $offset,
            'sort' => in_array($sort, Order::SORT_TYPES) ? $sort : 'createdAt',
        ];

        if (! empty($filters)) {
            $queryParams = array_merge($queryParams, $this->getFilters($filters));
        }

        $response = $this->httpClient->sendRequest($this->endpoint, 'GET', [
            'query' => $queryParams,
        ]);

        return new OrderListResponse($response);
    }
}
