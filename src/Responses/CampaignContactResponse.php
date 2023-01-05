<?php

namespace Lvandi\OmnisendSDK\Responses;

use Psr\Http\Message\ResponseInterface;
use Lvandi\OmnisendSDK\DTO\CampaignContact;

class CampaignContactResponse extends BaseResponse
{
    private CampaignContact $contact;

    public function __construct(ResponseInterface $response)
    {
        parent::__construct($response);

        // 204 status code means empty response, then we set
        // the body to an empty array for custom response processing
        $body = $response->getStatusCode() !== 204
            ? json_decode($response->getBody())
            : [];

        $this->contact = new CampaignContact($body);
    }

    /**
     * @return CampaignContact
     */
    public function getContact(): CampaignContact
    {
        return $this->contact;
    }
}
