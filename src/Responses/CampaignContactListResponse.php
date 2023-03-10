<?php

namespace Lvandi\OmnisendSDK\Responses;

use Lvandi\OmnisendSDK\Types\Paging;
use Psr\Http\Message\ResponseInterface;
use Lvandi\OmnisendSDK\Types\CampaignContact;

class CampaignContactListResponse extends BaseResponse
{
    /** @var array<CampaignContact> */
    private array $contacts = [];

    private Paging $paging;

    public function __construct(ResponseInterface $response)
    {
        parent::__construct($response);

        /** @var \stdClass $body */
        $body = json_decode($response->getBody());

        if (! empty($body->contacts)) {
            foreach ($body->contacts as $contact) {
                $this->contacts[] = new CampaignContact($contact);
            }
        }

        $this->paging = new Paging($body->paging);
    }

    /**
     * @return array<CampaignContact>
     */
    public function getContacts(): array
    {
        return $this->contacts;
    }

    /**
     * @return Paging
     */
    public function getPaging(): Paging
    {
        return $this->paging;
    }
}
