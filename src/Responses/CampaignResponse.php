<?php

namespace Lvandi\OmnisendSDK\Responses;

use Lvandi\OmnisendSDK\DTO\Campaign;
use Psr\Http\Message\ResponseInterface;

class CampaignResponse extends BaseResponse
{
    private Campaign $campaign;

    public function __construct(ResponseInterface $response)
    {
        parent::__construct($response);

        // 204 status code means empty response, then we set
        // the body to an empty array for custom response processing
        $body = $response->getStatusCode() !== 204
            ? json_decode($response->getBody())
            : [];

        $this->campaign = Campaign::fromRawData($body);
    }

    public function getCampaign(): Campaign
    {
        return $this->campaign;
    }
}
