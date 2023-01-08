<?php

declare(strict_types=1);

namespace Lvandi\OmnisendSDK\Types;

use stdClass;
use JsonSerializable;
use Lvandi\OmnisendSDK\Traits\JsonSerializeTrait;

class StatByDevice implements JsonSerializable
{
    use JsonSerializeTrait;

    private ?CampaignStat $opened;

    private ?CampaignStat $clicked;

    public function __construct(stdClass $statByDevice)
    {
        $this->opened = new CampaignStat($statByDevice->opened);
        $this->clicked = new CampaignStat($statByDevice->clicked);
    }

    /**
     * @return CampaignStat|null
     */
    public function getOpened(): ?CampaignStat
    {
        return $this->opened;
    }

    /**
     * @return CampaignStat|null
     */
    public function getClicked(): ?CampaignStat
    {
        return $this->clicked;
    }
}
