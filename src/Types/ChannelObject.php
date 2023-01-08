<?php

declare(strict_types=1);

namespace Lvandi\OmnisendSDK\Types;

use JsonSerializable;
use Lvandi\OmnisendSDK\Traits\JsonSerializeTrait;

class ChannelObject implements JsonSerializable
{
    use JsonSerializeTrait;

    public const STATUS_SUBSCRIBED = 'subscribed';

    public const STATUS_NONSUBSCRIBED = 'nonSubscribed';

    public const STATUS_UNSUBSCRIBED = 'unsubscribed';

    private string $status;

    private ?string $statusDate = null;

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return ChannelObject
     */
    public function setStatus(string $status): ChannelObject
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getStatusDate(): ?string
    {
        return $this->statusDate;
    }

    /**
     * @param string|null $statusDate
     * @return ChannelObject
     */
    public function setStatusDate(?string $statusDate): ChannelObject
    {
        $this->statusDate = $statusDate;

        return $this;
    }
}
