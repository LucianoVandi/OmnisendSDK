<?php

namespace Lvandi\OmnisendSDK\DTO;

class Image implements \JsonSerializable
{
    use JsonSerializeTrait;

    private ?string $imageID;

    private ?string $url;

    private ?bool $isDefault;

    /**
     * @var array<string>
     */
    private ?array $variantIDs;

    public function __construct(\stdClass $image)
    {
        $this->imageID = $image->imageID;
        $this->url = $image->url;
        $this->isDefault = $image->isDefault ?? false;
        $this->variantIDs = $image->variantIDs;
    }

    /**
     * @return string|null
     */
    public function getImageID(): ?string
    {
        return $this->imageID;
    }

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @return bool|null
     */
    public function getIsDefault(): ?bool
    {
        return $this->isDefault;
    }

    /**
     * @return array|null
     */
    public function getVariantIDs(): ?array
    {
        return $this->variantIDs;
    }
}
