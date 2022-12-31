<?php

namespace Lvandi\OmnisendSDK\DTO;

use InvalidArgumentException;

class CartProduct implements \JsonSerializable
{
    use JsonSerializeTrait;

    private string $cartProductID;

    private string $productID;

    private string $variantID;

    private ?string $sku;

    private string $title;

    private ?string $description;

    private ?string $currency;

    private int $quantity;

    private int $price;

    private ?int $oldPrice;

    private ?int $discount;

    private ?string $imageUrl;

    private ?string $productUrl;

    /**
     * @param array|\stdClass $data
     * @return CartProduct
     */
    public static function fromRawData($data): CartProduct
    {
        if (is_array($data)) {
            $data = json_decode(
                (string) json_encode($data)
            );
        } elseif (! is_object($data)) {
            throw new InvalidArgumentException('Argument must be either an array or object.');
        }

        $cartProduct = new self();

        $cartProduct->setProductID($data->productID)
            ->setCartProductID($data->cartProductID)
            ->setVariantID($data->variantID ?? $data->productID)
            ->setSku($data->sku)
            ->setTitle($data->title)
            ->setDescription($data->description)
            ->setQuantity($data->quantity)
            ->setPrice($data->price)
            ->setOldPrice($data->oldPrice)
            ->setDiscount($data->discount)
            ->setCurrency($data->currency)
            ->setImageUrl($data->imageUrl)
            ->setProductUrl($data->productUrl);

        return $cartProduct;
    }

    /**
     * @return string
     */
    public function getCartProductID(): string
    {
        return $this->cartProductID;
    }

    /**
     * @param string $cartProductID
     * @return CartProduct
     */
    public function setCartProductID(string $cartProductID): CartProduct
    {
        $this->cartProductID = $cartProductID;

        return $this;
    }

    /**
     * @return string
     */
    public function getProductID(): string
    {
        return $this->productID;
    }

    /**
     * @param string $productID
     * @return CartProduct
     */
    public function setProductID(string $productID): CartProduct
    {
        $this->productID = $productID;

        return $this;
    }

    /**
     * @return string
     */
    public function getVariantID(): string
    {
        return $this->variantID;
    }

    /**
     * @param string $variantID
     * @return CartProduct
     */
    public function setVariantID(string $variantID): CartProduct
    {
        $this->variantID = $variantID;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSku(): ?string
    {
        return $this->sku;
    }

    /**
     * @param string|null $sku
     * @return CartProduct
     */
    public function setSku(?string $sku): CartProduct
    {
        $this->sku = $sku;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return CartProduct
     */
    public function setTitle(string $title): CartProduct
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     * @return CartProduct
     */
    public function setDescription(?string $description): CartProduct
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     * @return CartProduct
     */
    public function setQuantity(int $quantity): CartProduct
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param int $price
     * @return CartProduct
     */
    public function setPrice(int $price): CartProduct
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getOldPrice(): ?int
    {
        return $this->oldPrice;
    }

    /**
     * @param int|null $oldPrice
     * @return CartProduct
     */
    public function setOldPrice(?int $oldPrice): CartProduct
    {
        $this->oldPrice = $oldPrice;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getDiscount(): ?int
    {
        return $this->discount;
    }

    /**
     * @param int|null $discount
     * @return CartProduct
     */
    public function setDiscount(?int $discount): CartProduct
    {
        $this->discount = $discount;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    /**
     * @param string|null $imageUrl
     * @return CartProduct
     */
    public function setImageUrl(?string $imageUrl): CartProduct
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getProductUrl(): ?string
    {
        return $this->productUrl;
    }

    /**
     * @param string|null $productUrl
     * @return CartProduct
     */
    public function setProductUrl(?string $productUrl): CartProduct
    {
        $this->productUrl = $productUrl;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    /**
     * @param string|null $currency
     * @return CartProduct
     */
    public function setCurrency(?string $currency): CartProduct
    {
        $this->currency = $currency;
        return $this;
    }


}
