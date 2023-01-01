<?php

namespace Lvandi\OmnisendSDK\DTO;

class Event
{
    private ?string $eventId;

    private ?string $name;

    private ?string $systemName = '';

    private ?bool $enabled;

    private ?string $createdAt;

    private ?string $updatedAt;

    private ?array $fields;

    public function __construct(\stdClass $data)
    {
        $this->eventId = $data->eventID ?? null;
        $this->name = $data->name ?? null;
        $this->enabled = $data->enabled ?? null;
        $this->createdAt = $data->createdAt ?? null;
        $this->updatedAt = $data->updatedAt ?? null;
        $this->fields = $data->fields ?? [];
    }

    /**
     * @return string
     */
    public function getEventId(): string
    {
        return $this->eventId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSystemName(): string
    {
        return $this->systemName;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    /**
     * @return array<\stdClass>
     */
    public function getFields(): array
    {
        return $this->fields;
    }
}
