<?php

namespace Lvandi\OmnisendSDK\Resources;

use Lvandi\OmnisendSDK\DTO\Product;
use Lvandi\OmnisendSDK\Responses\ProductResponse;
use Lvandi\OmnisendSDK\Responses\ProductListResponse;

class Products extends BaseResource
{
    private string $endpoint = 'products';

    protected array $listFilters = ['vendor', 'type'];

    /**
     * Get Product information
     *
     * @param string $productID
     * @return ProductResponse
     */
    public function get(string $productID): ProductResponse
    {
        $uri = $this->endpoint . '/' . $productID;

        $response = $this->httpClient->sendRequest($uri, 'GET');

        return new ProductResponse($response);
    }

    /**
     * Create a new Product.
     * At least one variant is required for each product.
     * A variant can use the same ID (productID) and title (title) as the parent product.
     *
     * @param Product $product
     * @return ProductResponse
     */
    public function create(Product $product): ProductResponse
    {
        $response = $this->httpClient->sendRequest($this->endpoint, 'POST', [
            'body' => json_encode($product),
        ]);

        return new ProductResponse($response);
    }

    /**
     * Replace product. Pass all product info. Not passed fields will be deleted.
     * At least one variant is required for each product.
     * A variant can use the same ID (productID) and title (title) as the parent product.
     *
     * @param string $productID
     * @param Product $product
     * @return ProductResponse
     */
    public function replace(string $productID, Product $product): ProductResponse
    {
        $uri = $this->endpoint . '/' . $productID;

        $response = $this->httpClient->sendRequest($uri, 'PUT', [
            'body' => json_encode($product),
        ]);

        return new ProductResponse($response);
    }

    /**
     * Delete a Product
     *
     * @param string $productID
     * @return ProductResponse
     */
    public function delete(string $productID): ProductResponse
    {
        $uri = $this->endpoint . '/' . $productID;

        $response = $this->httpClient->sendRequest($uri, 'DELETE');

        return new ProductResponse($response);
    }

    /**
     * List Products. Result can be filtered by "vendor" or "type".
     *
     * @param array|null $filters
     * @param int|null $limit
     * @param int|null $offset
     * @param string|null $sort
     * @return ProductListResponse
     */
    public function list(
        ?array $filters = null,
        ?int $limit = 100,
        ?int $offset = 0,
        ?string $sort = 'createdAt'
    ): ProductListResponse {
        $queryParams = [
            'limit' => $limit,
            'offset' => $offset,
            'sort' => $sort,
        ];

        if (! empty($filters)) {
            $queryParams = array_merge($queryParams, $this->applyListFilters($filters));
        }

        $response = $this->httpClient->sendRequest($this->endpoint, 'GET', [
            'query' => $queryParams,
        ]);

        return new ProductListResponse($response);
    }
}
