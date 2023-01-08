<?php

declare(strict_types=1);

namespace Lvandi\OmnisendSDK\Responses;

use stdClass;
use Psr\Http\Message\ResponseInterface;

class CartProductResponse extends BaseResponse
{
    private ?string $cartID;

    private ?string $cartProductID;

    private ?string $productID;

    private ?string $variantID;

    public function __construct(ResponseInterface $response)
    {
        parent::__construct($response);

        $body = $this->getDecodedBody();

        if (is_object($body)) {
            /** @var stdClass $body */
            $this->cartID = $body->cartID;
            $this->cartProductID = $body->cartProductID;
            $this->productID = $body->productID;
            $this->variantID = $body->variantID;
        }
    }

    /**
     * @return string|null
     */
    public function getCartID(): ?string
    {
        return $this->cartID;
    }

    /**
     * @return string|null
     */
    public function getCartProductID(): ?string
    {
        return $this->cartProductID;
    }

    /**
     * @return string|null
     */
    public function getProductID(): ?string
    {
        return $this->productID;
    }

    /**
     * @return string|null
     */
    public function getVariantID(): ?string
    {
        return $this->variantID;
    }
}
