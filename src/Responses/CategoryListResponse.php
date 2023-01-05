<?php

namespace Lvandi\OmnisendSDK\Responses;

use Lvandi\OmnisendSDK\Types\Paging;
use Lvandi\OmnisendSDK\Types\Category;
use Psr\Http\Message\ResponseInterface;

class CategoryListResponse extends BaseResponse
{
    /** @var array<Category> */
    private array $categories = [];

    private Paging $paging;

    public function __construct(ResponseInterface $response)
    {
        parent::__construct($response);

        /** @var \stdClass $body */
        $body = json_decode($response->getBody());

        if (! empty($body->categories)) {
            foreach ($body->categories as $category) {
                $this->categories[] = Category::fromRawData($category);
            }
        }

        $this->paging = new Paging($body->paging);
    }

    /**
     * @return array<Category>
     */
    public function getCategories(): array
    {
        return $this->categories;
    }

    /**
     * @return Paging
     */
    public function getPaging(): Paging
    {
        return $this->paging;
    }
}
