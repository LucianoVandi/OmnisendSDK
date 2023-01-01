<?php

namespace Lvandi\OmnisendSDK\Resources;

use Lvandi\OmnisendSDK\DTO\Cart;
use Lvandi\OmnisendSDK\DTO\CartProduct;
use Lvandi\OmnisendSDK\Responses\CartResponse;
use Lvandi\OmnisendSDK\Responses\CartListResponse;
use Lvandi\OmnisendSDK\Responses\CartProductResponse;

class Carts extends BaseResource
{
    private string $endpoint = 'carts';

    protected array $listFilters = [
        'email',
        'phone',
        'contactID',
        'segmentID',
        'dateFrom',
        'dateTo',
        'updatedFrom',
        'updatedTo',
    ];

    /**
     * Create a new Cart
     * While posting new cart email or/and contactID must be provided.
     *
     * @see https://api-docs.omnisend.com/reference/post_carts
     * @param Cart $cart
     * @return CartResponse
     */
    public function create(Cart $cart): CartResponse
    {
        $response = $this->httpClient->sendRequest($this->endpoint, 'POST', [
            'body' => json_encode($cart),
        ]);

        return new CartResponse($response);
    }

    /**
     * Get Cart details
     *
     * @param string $cartID
     * @return CartResponse
     */
    public function get(string $cartID): CartResponse
    {
        $uri = $this->endpoint . '/' . $cartID;

        $response = $this->httpClient->sendRequest($uri, 'GET');

        return new CartResponse($response);
    }

    /**
     * Replace existing cart
     * Replace (update) existing cart. All stored cart data will be overwritten with request data.
     * This method used to replace cart with all its products - use it if you are posting full cart data.
     *
     * @param string $cartID
     * @param Cart $cart
     * @return CartResponse
     */
    public function replace(string $cartID, Cart $cart): CartResponse
    {
        $uri = $this->endpoint . '/' . $cartID;

        $response = $this->httpClient->sendRequest($uri, 'PUT', [
            'body' => json_encode($cart),
        ]);

        return new CartResponse($response);
    }

    /**
     * Update existing cart.
     * Use to update cart info, add products or update existing in cart products.
     *
     * @param string $cartID
     * @param Cart $cart
     * @return CartResponse
     */
    public function update(string $cartID, Cart $cart): CartResponse
    {
        $uri = $this->endpoint . '/' . $cartID;

        $response = $this->httpClient->sendRequest($uri, 'PATCH', [
            'body' => json_encode($cart),
        ]);

        return new CartResponse($response);
    }

    /**
     * Delete existing cart.
     *
     * @param string $cartID
     * @return CartResponse
     */
    public function delete(string $cartID): CartResponse
    {
        $uri = $this->endpoint . '/' . $cartID;

        $response = $this->httpClient->sendRequest($uri, 'DELETE');

        return new CartResponse($response);
    }

    /**
     * Get a list of existing Carts.
     *
     * Result can be sorted by:
     * - createdAt DESC (the newest first)
     * - updatedAt DESC (last updated first)
     * - cartSum DESC (the biggest amounts first)
     *
     * Result can be filtered by:
     * - email
     * - phone
     * - contactID
     * - segmentID
     * - dateFrom (Cart creation date from. Format: YYYY-MM-DD)
     * - dateTo (Cart creation date to. Format: YYYY-MM-DD)
     * - updatedFrom (Cart update date from. Format: YYYY-MM-DD)
     * - updatedTo (Cart update date to. Format: YYYY-MM-DD)
     *
     * @param array|null $filters
     * @param int|null $limit
     * @param int|null $offset
     * @param string|null $sort
     * @return CartListResponse
     */
    public function list(
        ?array $filters = null,
        ?int $limit = 100,
        ?int $offset = 0,
        ?string $sort = 'updatedAt'
    ): CartListResponse {
        $queryParams = [
            'limit' => $limit,
            'offset' => $offset,
            'sort' => $sort,
        ];

        if (! empty($filters)) {
            $queryParams = array_merge($queryParams, $this->getFilters($filters));
        }

        $response = $this->httpClient->sendRequest($this->endpoint, 'GET', [
            'query' => $queryParams,
        ]);

        return new CartListResponse($response);
    }

    /**
     * Add new Product to an existing Cart
     *
     * @param string $cartID
     * @param CartProduct $product
     * @return CartProductResponse
     */
    public function addProduct(string $cartID, CartProduct $product): CartProductResponse
    {
        $uri = $this->endpoint . '/' . $cartID . '/products';

        $response = $this->httpClient->sendRequest($uri, 'POST', [
            'body' => json_encode($product),
        ]);

        return new CartProductResponse($response);
    }

    /**
     * Replace existing product (change quantity, price or whole product)
     *
     * @param string $cartID
     * @param string $cartProductID
     * @param CartProduct $product
     * @return CartProductResponse
     */
    public function replaceProduct(
        string $cartID,
        string $cartProductID,
        CartProduct $product
    ): CartProductResponse {
        $uri = $this->endpoint . '/' . $cartID . '/products/' . $cartProductID;

        $response = $this->httpClient->sendRequest($uri, 'PUT', [
            'body' => json_encode($product),
        ]);

        return new CartProductResponse($response);
    }

    /**
     * Update product in cart (change quantity, price, etc).
     * Pass only fields, you want to update.
     *
     * @param string $cartID
     * @param string $cartProductID
     * @param CartProduct $product
     * @return CartProductResponse
     */
    public function updateProduct(
        string $cartID,
        string $cartProductID,
        CartProduct $product
    ): CartProductResponse {
        $uri = $this->endpoint . '/' . $cartID . '/products/' . $cartProductID;

        $response = $this->httpClient->sendRequest($uri, 'PATCH', [
            'body' => json_encode($product),
        ]);

        return new CartProductResponse($response);
    }

    /**
     * Remove product from cart.
     *
     * @param string $cartID
     * @param string $cartProductID
     * @return CartProductResponse
     */
    public function removeProduct(string $cartID, string $cartProductID): CartProductResponse
    {
        $uri = $this->endpoint . '/' . $cartID . '/products/' . $cartProductID;

        $response = $this->httpClient->sendRequest($uri, 'DELETE');

        return new CartProductResponse($response);
    }
}
