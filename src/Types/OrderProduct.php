<?php

namespace Lvandi\OmnisendSDK\Types;

class OrderProduct implements \JsonSerializable
{
    use JsonSerializeTrait;

    private ?string $productID;

    private ?string $sku;

    private ?string $variantID;

    private ?string $variantTitle;

    private ?string $title;

    private ?string $vendor;

    private ?int $quantity;

    private ?int $price;

    private ?int $discount;

    private ?int $weight;

    private ?string $imageUrl;

    private ?string $productUrl;

    /** @var array<string>|null */
    private ?array $categoryIDs;

    /** @var array<string>|null */
    private ?array $tags;

    public function __construct(\stdClass $product)
    {
        $this->productID = $product->productID;
        $this->variantID = $product->variantID;
        $this->sku = $product->sku;
        $this->variantTitle = $product->variantTitle;
        $this->title = $product->title;
        $this->vendor = $product->vendor;
        $this->quantity = $product->quantity;
        $this->price = $product->price;
        $this->discount = $product->discount;
        $this->weight = $product->weight;
        $this->imageUrl = $product->imageUrl;
        $this->productUrl = $product->productUrl;
        $this->categoryIDs = $product->categoryIDs;
        $this->tags = $product->tags;
    }
}
