<?php

namespace Lvandi\OmnisendSDK\Responses;

use Lvandi\OmnisendSDK\Types\Paging;
use Lvandi\OmnisendSDK\Types\Product;
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
        $body = $this->getDecodedBody();

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
