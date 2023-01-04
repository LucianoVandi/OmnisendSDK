<?php

namespace Lvandi\OmnisendSDK\DTO;

class Segment implements \JsonSerializable
{
    use JsonSerializeTrait;

    private ?string $segmentID;

    public function __construct(\stdClass $segment)
    {
        $this->segmentID = $segment->segmentID;
    }

    /**
     * @return string|null
     */
    public function getSegmentID(): ?string
    {
        return $this->segmentID;
    }

}
