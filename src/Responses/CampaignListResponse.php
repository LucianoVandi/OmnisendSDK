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

    private Paging $paging;

    public function __construct(ResponseInterface $response)
    {
        parent::__construct($response);

        /** @var \stdClass $body */
        $body = json_decode($response->getBody());

        if (! empty($body->carts)) {
            foreach ($body->campaigns as $campaign) {
                $this->campaigns[] = Campaign::fromRawData($campaign);
            }
        }

        $this->paging = new Paging($body->paging);
    }

    /**
     * @return array<Campaign>
     */
    public function getCampaigns(): array
    {
        return $this->campaigns;
    }

    /**
     * @return Paging
     */
    public function getPaging(): Paging
    {
        return $this->paging;
    }
}
