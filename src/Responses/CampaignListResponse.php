<?php

namespace Lvandi\OmnisendSDK\Responses;

use Lvandi\OmnisendSDK\Types\Paging;
use Lvandi\OmnisendSDK\Types\Campaign;
use Psr\Http\Message\ResponseInterface;

class CampaignListResponse extends BaseResponse
{
    /** @var array<Campaign> */
    private array $campaigns = [];

    private ?Paging $paging;

    public function __construct(ResponseInterface $response)
    {
        parent::__construct($response);

        /** @var \stdClass $body */
        $body = $this->getDecodedBody();

        if (! empty($body->campaign)) {
            foreach ($body->campaign as $campaign) {
                $this->campaigns[] = Campaign::fromRawData($campaign);
            }
        }

        $this->paging = ! is_null($body->paging)
            ? new Paging($body->paging)
            : null;
    }

    /**
     * @return array<Campaign>
     */
    public function getCampaigns(): array
    {
        return $this->campaigns;
    }

    /**
     * @return Paging|null
     */
    public function getPaging(): ?Paging
    {
        return $this->paging;
    }
}
