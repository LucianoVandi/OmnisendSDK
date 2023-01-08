<?php

declare(strict_types=1);

namespace Lvandi\OmnisendSDK\Types;

use stdClass;
use JsonSerializable;
use Lvandi\OmnisendSDK\Traits\JsonSerializeTrait;

class Variant implements JsonSerializable
{
    use JsonSerializeTrait;

    private string $variantID;

    private string $title;

    private ?string $sku;

    private ?string $status;

    private int $price;

    private ?int $oldPrice;

    private ?string $productUrl;

    private ?string $imageID;

    private ?object $customFields;

    public function __construct(stdClass $variant)
    {
        $this->variantID = $variant->variantID;
        $this->title = $variant->title;
        $this->sku = $variant->sku ?? null;
        $this->status = $variant->status;
        $this->price = (int) $variant->price;
        $this->oldPrice = (int) $variant->oldPrice;
        $this->productUrl = $variant->productUrl;
        $this->imageID = $variant->imageID ?? null;
        $this->customFields = $variant->customFields ?? null;
    }

    /**
     * @return string
     */
    public function getVariantID(): string
    {
        return $this->variantID;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string|null
     */
    public function getSku(): ?string
    {
        return $this->sku;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @return int|null
     */
    public function getOldPrice(): ?int
    {
        return $this->oldPrice;
    }

    /**
     * @return string|null
     */
    public function getProductUrl(): ?string
    {
        return $this->productUrl;
    }

    /**
     * @return string|null
     */
    public function getImageID(): ?string
    {
        return $this->imageID;
    }

    /**
     * @return object|null
     */
    public function getCustomFields(): ?object
    {
        return $this->customFields;
    }
}
