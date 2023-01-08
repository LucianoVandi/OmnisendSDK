<?php

declare(strict_types=1);

namespace Lvandi\OmnisendSDK\Types;

use JsonSerializable;
use Lvandi\OmnisendSDK\Traits\JsonSerializeTrait;

class Segment implements JsonSerializable
{
    use JsonSerializeTrait;

    private ?string $segmentID;

    public function __construct(string $segmentID)
    {
        $this->segmentID = $segmentID;
    }

    /**
     * @return string|null
     */
    public function getSegmentID(): ?string
    {
        return $this->segmentID;
    }
}
