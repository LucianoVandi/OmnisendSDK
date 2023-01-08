<?php

declare(strict_types=1);

namespace Lvandi\OmnisendSDK\Types;

use stdClass;
use ReflectionClass;
use JsonSerializable;
use ReflectionProperty;
use Lvandi\OmnisendSDK\Traits\JsonSerializeTrait;
use Lvandi\OmnisendSDK\Exceptions\MissingRequiredPropertyException;

class ProductView implements JsonSerializable
{
    use JsonSerializeTrait;

    private string $productID;

    private string $variantID;

    private string $currency;

    private ?array $tags;

    private int $price;

    private ?int $oldPrice;

    private string $title;

    private ?string $description;

    private string $imageUrl;

    private string $productUrl;

    private ?string $vendor;

    private ?stdClass $callbacks;

    /**
     * @param array $attributes
     * @return ProductView
     */
    public static function fromArray(array $attributes): ProductView
    {
        $productView = new self();

        $productView->setProductID($attributes['productID'])
            ->setVariantID($attributes['variantID'])
            ->setCurrency($attributes['currency'])
            ->setTags($attributes['tags'] ?? null)
            ->setPrice($attributes['price'])
            ->setOldPrice($attributes['oldPrice'] ?? null)
            ->setTitle($attributes['title'])
            ->setDescription($attributes['description'] ?? null)
            ->setImageUrl($attributes['imageUrl'])
            ->setProductUrl($attributes['productUrl'])
            ->setVendor($attributes['vendor'])
            ->setCallbacks($attributes['callbacks']);

        return $productView;
    }

    public function toJsObject(): string
    {
        $properties = array_filter(
            get_object_vars($this),
            function ($value) {
                return null !== $value;
            }
        );

        $this->ensureHasRequiredProps($properties);

        $jsObject = [];

        foreach ($properties as $name => $value) {
            $type = gettype($value);

            switch($type) {
                case 'string':
                    $jsObject[] = '$'.$name.': "'.$value.'"';

                    break;
                case 'integer':
                    $jsObject[] = '$'.$name.': '.$value;

                    break;
                case 'array':
                    $string = '$'.$name.': [';

                    for ($i = 0; $i < count($value); $i++) {
                        $string .= '"'.$value[$i].'"';
                        if ($i < count($value) - 1) {
                            $string .= ',';
                        }
                    }

                    $string .= ']';

                    $jsObject[] = $string;

                    break;
                case 'object':
                    $properties = get_object_vars($value);
                    $string = '$'.$name.': {';

                    foreach ($properties as $k => $v) {
                        $string .= $k.': '.$v.',';
                    }

                    $string .= '}';
                    $jsObject[] = $string;

                    break;
                default:
            }
        }

        return '{'.implode(', ', $jsObject).'}';
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
     * @return ProductView
     */
    public function setProductID(string $productID): ProductView
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
     * @return ProductView
     */
    public function setVariantID(string $variantID): ProductView
    {
        $this->variantID = $variantID;

        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     * @return ProductView
     */
    public function setCurrency(string $currency): ProductView
    {
        $this->currency = $currency;

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
     * @return ProductView
     */
    public function setTags(?array $tags): ProductView
    {
        $this->tags = $tags;

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
     * @return ProductView
     */
    public function setPrice(int $price): ProductView
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
     * @return ProductView
     */
    public function setOldPrice(?int $oldPrice): ProductView
    {
        $this->oldPrice = $oldPrice;

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
     * @return ProductView
     */
    public function setTitle(string $title): ProductView
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
     * @return ProductView
     */
    public function setDescription(?string $description): ProductView
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }

    /**
     * @param string $imageUrl
     * @return ProductView
     */
    public function setImageUrl(string $imageUrl): ProductView
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getProductUrl(): string
    {
        return $this->productUrl;
    }

    /**
     * @param string $productUrl
     * @return ProductView
     */
    public function setProductUrl(string $productUrl): ProductView
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
     * @return ProductView
     */
    public function setVendor(?string $vendor): ProductView
    {
        $this->vendor = $vendor;

        return $this;
    }

    /**
     * @return stdClass|null
     */
    public function getCallbacks(): ?stdClass
    {
        return $this->callbacks;
    }

    /**
     * @param stdClass|null $callbacks
     * @return ProductView
     */
    public function setCallbacks(?stdClass $callbacks): ProductView
    {
        $this->callbacks = $callbacks;

        return $this;
    }

    /**
     * @return array
     */
    private function getRequiredProps(): array
    {
        $requiredProps = [];

        $reflection = new ReflectionClass($this);
        $properties = $reflection->getProperties(ReflectionProperty::IS_PRIVATE);

        foreach ($properties as $property) {
            if ($property->getType()->allowsNull()) {
                continue;
            }

            $requiredProps[] = $property->getName();
        }

        return $requiredProps;
    }

    /**
     * @param array $attributes
     * @return void
     */
    private function ensureHasRequiredProps(array $attributes): void
    {
        $requiredProps = $this->getRequiredProps();

        foreach ($requiredProps as $prop) {
            if (! array_key_exists($prop, $attributes)) {
                throw new MissingRequiredPropertyException('Property required: '.$prop);
            }
        }
    }
}
