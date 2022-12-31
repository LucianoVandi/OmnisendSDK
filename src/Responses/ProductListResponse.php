<?php

namespace Lvandi\OmnisendSDK\Responses;

use Lvandi\OmnisendSDK\DTO\Paging;
use Lvandi\OmnisendSDK\DTO\Product;
use Psr\Http\Message\ResponseInterface;

class ProductListResponse extends BaseResponse
{
    /** @var array<Product> */
    private array $products = [];

    private Paging $paging;

    public function __construct(ResponseInterface $response)
    {
        parent::__construct($response);

        /** @var \stdClass $body */
        $body = json_decode($response->getBody());

        if (! empty($body->products)) {
            foreach ($body->products as $product) {
                $this->products[] = Product::fromRawData($product);
            }
        }

        $this->paging = new Paging($body->paging);
    }

    /**
     * @return array<Product>
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    /**
     * @return Paging
     */
    public function getPaging(): Paging
    {
        return $this->paging;
    }
}
