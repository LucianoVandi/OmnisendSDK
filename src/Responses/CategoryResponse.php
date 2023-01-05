<?php

namespace Lvandi\OmnisendSDK\Responses;

use Lvandi\OmnisendSDK\Types\Category;
use Psr\Http\Message\ResponseInterface;

class CategoryResponse extends BaseResponse
{
    private Category $category;

    public function __construct(ResponseInterface $response)
    {
        parent::__construct($response);

        // 204 status code means empty response, then we set
        // the body to an empty array for custom response processing
        $body = $response->getStatusCode() !== 204
            ? json_decode($response->getBody())
            : [];

        $this->category = Category::fromRawData($body);
    }

    public function getCategory(): Category
    {
        return $this->category;
    }
}
