<?php

declare(strict_types=1);

namespace Lvandi\OmnisendSDK\Responses;

use Psr\Http\Message\ResponseInterface;
use Lvandi\OmnisendSDK\Types\CampaignContact;

class CampaignContactResponse extends BaseResponse
{
    private CampaignContact $contact;

    public function __construct(ResponseInterface $response)
    {
        parent::__construct($response);

        $body = $this->getDecodedBody();

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
