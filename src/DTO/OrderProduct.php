<?php

namespace Lvandi\OmnisendSDK\DTO;

use InvalidArgumentException;

class OrderProduct implements \JsonSerializable
{
    use JsonSerializeTrait;

    public ?string $productID;

    public ?string $sku;

    public ?string $variantID;

    public ?string $variantTitle;

    public ?string $title;

    public ?string $vendor;

    public ?int $quantity;

    public ?int $price;

    public ?int $discount;

    public ?int $weight;

    public ?string $imageUrl;

    public ?string $productUrl;

    /** @var array<string>|null  */
    public ?array $categoryIDs;

    /** @var array<string>|null  */
    public ?array $tags;

}
