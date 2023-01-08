<?php

declare(strict_types=1);

namespace Lvandi\OmnisendSDK\Types;

use JsonSerializable;
use InvalidArgumentException;
use Lvandi\OmnisendSDK\Traits\JsonSerializeTrait;

class Product implements JsonSerializable
{
    use JsonSerializeTrait;

    public const IN_STOCK = 'inStock';

    public const OUT_OF_STOCK = 'outOfStock';

    public const NOT_AVAILABLE = 'notAvailable';

    public const STATUSES = [
        self::IN_STOCK,
        self::OUT_OF_STOCK,
        self::NOT_AVAILABLE,
    ];

    private ?string $productID;

    private ?string $title;

    private ?string $status;

    private ?string $description;

    // ISO currency code.
    private ?string $currency;

    private ?string $productUrl;

    private ?string $vendor;

    private ?string $type;

    private ?string $createdAt;

    private ?string $updatedAt;

    /**
     * @var array<string>|null
     */
    private ?array $tags;

    /**
     * @var array<string>|null
     */
    private ?array $categoryIDs;

    /**
     * @var array<Image>
     */
    private ?array $images;

    /**
     * @var array<Variant>
     */
    private ?array $variants;

    /**
     * @param array|object $data
     * @return Product
     */
    public static function fromRawData($data): Product
    {
        if (is_array($data)) {
            $data = json_decode(
                (string) json_encode($data)
            );
        } elseif (! is_object($data)) {
            throw new InvalidArgumentException('Argument must be either an array or object.');
        }

        $status = in_array($data->status, self::STATUSES)
            ? $data->status
            : null;

        $product = new self();

        if ($data->images && is_array($data->images)) {
            $images = [];
            foreach ($data->images as $image) {
                $images[] = new Image($image);
            }
        }

        if ($data->variants && is_array($data->variants)) {
            $variants = [];
            foreach ($data->variants as $variant) {
                $variants[] = new Variant($variant);
            }
        }

        $product->setProductID($data->productID)
            ->setTitle($data->title)
            ->setStatus($status)
            ->setDescription($data->description ?? null)
            ->setCurrency($data->currency)
            ->setProductUrl($data->productUrl ?? null)
            ->setVendor($data->vendor ?? null)
            ->setType($data->type ?? null)
            ->setCreatedAt($data->createdAt ?? null)
            ->setUpdatedAt($data->updatedAt ?? null)
            ->setTags($data->tags ?? null)
            ->setCategoryIDs($data->categoryIDs ?? null)
            ->setImages($images ?? null)
            ->setVariants($variants ?? null);

        return $product;
    }

    /**
     * @return string|null
     */
    public function getProductID(): ?string
    {
        return $this->productID;
    }

    /**
     * @param string|null $productID
     * @return Product
     */
    public function setProductID(?string $productID): Product
    {
        $this->productID = $productID;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     * @return Product
     */
    public function setTitle(?string $title): Product
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     * @return Product
     */
    public function setStatus(?string $status): Product
    {
        $this->status = $status;

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
     * @return Product
     */
    public function setDescription(?string $description): Product
    {
        $this->description = $description;

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
     * @return Product
     */
    public function setCurrency(?string $currency): Product
    {
        $this->currency = $currency;

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
     * @return Product
     */
    public function setProductUrl(?string $productUrl): Product
    {
        $this->productUrl = $productUrl;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getVendor(): ?string
    {
        return $this->vendor;
    }

    /**
     * @param string|null $vendor
     * @return Product
     */
    public function setVendor(?string $vendor): Product
    {
        $this->vendor = $vendor;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     * @return Product
     */
    public function setType(?string $type): Product
    {
        $this->type = $type;

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
     * @return Product
     */
    public function setCreatedAt(?string $createdAt): Product
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
     * @return Product
     */
    public function setUpdatedAt(?string $updatedAt): Product
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getTags(): ?array
    {
        return $this->tags;
    }

    /**
     * @param array|null $tags
     * @return Product
     */
    public function setTags(?array $tags): Product
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getCategoryIDs(): ?array
    {
        return $this->categoryIDs;
    }

    /**
     * @param array|null $categoryIDs
     * @return Product
     */
    public function setCategoryIDs(?array $categoryIDs): Product
    {
        $this->categoryIDs = $categoryIDs;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getImages(): ?array
    {
        return $this->images;
    }

    /**
     * @param array|null $images
     * @return Product
     */
    public function setImages(?array $images): Product
    {
        $this->images = $images;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getVariants(): ?array
    {
        return $this->variants;
    }

    /**
     * @param array|null $variants
     * @return Product
     */
    public function setVariants(?array $variants): Product
    {
        $this->variants = $variants;

        return $this;
    }
}
