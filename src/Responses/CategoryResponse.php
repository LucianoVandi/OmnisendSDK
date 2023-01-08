<?php

declare(strict_types=1);

namespace Lvandi\OmnisendSDK\Responses;

use Lvandi\OmnisendSDK\Types\Category;
use Psr\Http\Message\ResponseInterface;

class CategoryResponse extends BaseResponse
{
    private Category $category;

    public function __construct(ResponseInterface $response)
    {
        parent::__construct($response);

        $body = $this->getDecodedBody();

        $this->category = Category::fromRawData($body);
    }

    public function getCategory(): Category
    {
        return $this->category;
    }
}
