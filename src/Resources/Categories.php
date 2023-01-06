<?php

namespace Lvandi\OmnisendSDK\Resources;

use Lvandi\OmnisendSDK\Types\Category;
use Lvandi\OmnisendSDK\Responses\CategoryResponse;
use Lvandi\OmnisendSDK\Responses\CategoryListResponse;

class Categories extends BaseResource
{
    private string $endpoint = 'categories';

    /**
     * Get an existing Category
     *
     * @param string $categoryID
     * @return CategoryResponse
     */
    public function get(string $categoryID): CategoryResponse
    {
        $uri = $this->endpoint . '/' . $categoryID;

        $response = $this->httpClient->sendRequest($uri, 'GET');

        return new CategoryResponse($response);
    }

    /**
     * Replace category.
     * Pass all category info. Not passed fields will be deleted.
     * For example if createdAt won't be passed, it will be overwritten with current date.
     *
     * @param string $categoryID
     * @param Category $category
     * @return CategoryResponse
     */
    public function replace(string $categoryID, Category $category): CategoryResponse
    {
        $uri = $this->endpoint . '/' . $categoryID;

        $response = $this->httpClient->sendRequest($uri, 'PUT', [
            'body' => json_encode($category),
        ]);

        return new CategoryResponse($response);
    }

    /**
     * Delete an existing Category
     *
     * @param string $categoryID
     * @return CategoryResponse
     */
    public function delete(string $categoryID): CategoryResponse
    {
        $uri = $this->endpoint . '/' . $categoryID; // DELETE

        $response = $this->httpClient->sendRequest($uri, 'DELETE');

        return new CategoryResponse($response);
    }

    /**
     * Get a list of categories.
     *
     * @param string|null $sort
     * @param int|null $limit
     * @param int|null $offset
     * @return CategoryListResponse
     */
    public function list(?string $sort = 'title', ?int $limit = 100, ?int $offset = 0): CategoryListResponse
    {
        $response = $this->httpClient->sendRequest($this->endpoint, 'GET', [
            'query' => [
                'sort' => $sort,
                'limit' => $limit,
                'offset' => $offset,
            ],
        ]);

        return new CategoryListResponse($response);
    }

    /**
     * @param Category $category
     * @return CategoryResponse
     */
    public function create(Category $category): CategoryResponse
    {
        $response = $this->httpClient->sendRequest($this->endpoint, 'POST', [
            'body' => json_encode($category),
        ]);

        return new CategoryResponse($response);
    }
}
