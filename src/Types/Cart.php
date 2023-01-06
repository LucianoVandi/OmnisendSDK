<?php

namespace Lvandi\OmnisendSDK\Types;

use InvalidArgumentException;

class Cart implements \JsonSerializable
{
    use JsonSerializeTrait;

    private ?string $contactID;

    /**
     * Unique cart ID. Generate your own ID.
     * Later you can use it to restore abandoned cart.
     * @var string|null
     */
    private ?string $cartID;

    private ?string $email;

    private ?string $phone;

    private ?string $createdAt;

    private ?string $updatedAt;

    /** @var string|null ISO currency code */
    private ?string $currency;

    private ?int $cartSum;

    private ?string $cartRecoveryUrl;

    /**
     * @var array<CartProduct>
     */
    private array $products;

    /**
     * @param array|object $data
     * @return Cart
     */
    public static function fromRawData($data): Cart
    {
        if (is_array($data)) {
            $data = json_decode(
                (string) json_encode($data)
            );
        } elseif (! is_object($data)) {
            throw new InvalidArgumentException('Argument must be either an array or object.');
        }

        $cart = new self();

        $cart->setCartID($data->cartID)
            ->setEmail($data->email)
            ->setContactID($data->contactID)
            ->setPhone($data->phone)
            ->setCreatedAt($data->createdAt)
            ->setUpdatedAt($data->updatedAt)
            ->setCurrency($data->currency)
            ->setCartSum($data->cartSum)
            ->setCartRecoveryUrl($data->cartRecoveryUrl);

        if ($data->products) {
            $products = [];

            foreach ($data->products as $product) {
                $products[] = CartProduct::fromRawData($product);
            }

            $cart->setProducts($products);
        }

        return $cart;
    }

    /**
     * @return string|null
     */
    public function getContactID(): ?string
    {
        return $this->contactID;
    }

    /**
     * @param string|null $contactID
     * @return Cart
     */
    public function setContactID(?string $contactID): Cart
    {
        $this->contactID = $contactID;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCartID(): ?string
    {
        return $this->cartID;
    }

    /**
     * @param string|null $cartID
     * @return Cart
     */
    public function setCartID(?string $cartID): Cart
    {
        $this->cartID = $cartID;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     * @return Cart
     */
    public function setEmail(?string $email): Cart
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string|null $phone
     * @return Cart
     */
    public function setPhone(?string $phone): Cart
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    /**
     * @param string|null $createdAt
     * @return Cart
     */
    public function setCreatedAt(?string $createdAt): Cart
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt;
    }

    /**
     * @param string|null $updatedAt
     * @return Cart
     */
    public function setUpdatedAt(?string $updatedAt): Cart
    {
        $this->updatedAt = $updatedAt;

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
     * @return Cart
     */
    public function setCurrency(?string $currency): Cart
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCartSum(): ?int
    {
        return $this->cartSum;
    }

    /**
     * @param int|null $cartSum
     * @return Cart
     */
    public function setCartSum(?int $cartSum): Cart
    {
        $this->cartSum = $cartSum;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCartRecoveryUrl(): ?string
    {
        return $this->cartRecoveryUrl;
    }

    /**
     * @param string|null $cartRecoveryUrl
     * @return Cart
     */
    public function setCartRecoveryUrl(?string $cartRecoveryUrl): Cart
    {
        $this->cartRecoveryUrl = $cartRecoveryUrl;

        return $this;
    }

    /**
     * @return array
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    /**
     * @param array $products
     * @return Cart
     */
    public function setProducts(array $products): Cart
    {
        $this->products = $products;

        return $this;
    }
}
