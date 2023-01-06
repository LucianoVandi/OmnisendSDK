<?php

namespace Lvandi\OmnisendSDK\Types;

class CampaignStat implements \JsonSerializable
{
    use JsonSerializeTrait;

    private ?int $desktop;

    private ?int $mobile;

    private ?int $tablet;

    public function __construct(\stdClass $campaignStat)
    {
        $this->desktop = $campaignStat->desktop;
        $this->mobile = $campaignStat->mobile;
        $this->tablet = $campaignStat->tablet;
    }
}
