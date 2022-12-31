<?php

namespace Lvandi\OmnisendSDK\Responses;

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

        // 204 status code means empty response, then we set
        // the body to an empty array for custom response processing
        $body = $response->getStatusCode() !== 204
            ? json_decode($response->getBody())
            : [];

        if (is_object($body)) {
            /** @var \stdClass $body */
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
