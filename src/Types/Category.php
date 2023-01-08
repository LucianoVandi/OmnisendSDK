<?php

declare(strict_types=1);

namespace Lvandi\OmnisendSDK\Types;

use JsonSerializable;
use InvalidArgumentException;

class Category implements JsonSerializable
{
    use JsonSerializeTrait;

    private ?string $categoryID;

    private ?string $title;

    private ?string $createdAt;

    private ?string $updatedAt;

    /**
     * @param array|object $data
     * @return Category
     */
    public static function fromRawData($data): Category
    {
        if (is_array($data)) {
            $data = json_decode(
                (string) json_encode($data)
            );
        } elseif (! is_object($data)) {
            throw new InvalidArgumentException('Argument must be either an array or object.');
        }

        $category = new self();

        $category->setCategoryID($data->categoryID)
            ->setTitle($data->title)
            ->setCreatedAt($data->createdAt)
            ->setUpdatedAt($data->updatedAt);

        return $category;
    }

    /**
     * @return string|null
     */
    public function getCategoryID(): ?string
    {
        return $this->categoryID;
    }

    /**
     * @param string|null $categoryID
     * @return Category
     */
    public function setCategoryID(?string $categoryID): Category
    {
        $this->categoryID = $categoryID;

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
     * @return Category
     */
    public function setTitle(?string $title): Category
    {
        $this->title = $title;

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
     * @return Category
     */
    public function setCreatedAt(?string $createdAt): Category
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
     * @return Category
     */
    public function setUpdatedAt(?string $updatedAt): Category
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
