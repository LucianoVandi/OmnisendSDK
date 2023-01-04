<?php

namespace Lvandi\OmnisendSDK\DTO;

class StatByDevice implements \JsonSerializable
{
    use JsonSerializeTrait;

    private ?CampaignStat $opened;

    private ?CampaignStat $clicked;

    public function __construct(\stdClass $statByDevice)
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
