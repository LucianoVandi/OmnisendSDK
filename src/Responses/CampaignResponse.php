<?php

declare(strict_types=1);

namespace Lvandi\OmnisendSDK\Responses;

use Lvandi\OmnisendSDK\Types\Campaign;
use Psr\Http\Message\ResponseInterface;

class CampaignResponse extends BaseResponse
{
    private Campaign $campaign;

    public function __construct(ResponseInterface $response)
    {
        parent::__construct($response);

        $body = $this->getDecodedBody();

        $this->campaign = Campaign::fromRawData($body);
    }

    public function getCampaign(): Campaign
    {
        return $this->campaign;
    }
}
