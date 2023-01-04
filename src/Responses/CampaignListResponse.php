<?php

namespace Lvandi\OmnisendSDK\Responses;

use Lvandi\OmnisendSDK\DTO\Campaign;
use Lvandi\OmnisendSDK\DTO\Cart;
use Lvandi\OmnisendSDK\DTO\Paging;
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
        $body = json_decode($response->getBody());

        if (! empty($body->campaign)) {
            foreach ($body->campaign as $campaign) {
                $this->campaigns[] = Campaign::fromRawData($campaign);
            }
        }

        $this->paging = !is_null($body->paging)
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
