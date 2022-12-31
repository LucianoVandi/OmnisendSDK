<?php

namespace Lvandi\OmnisendSDK\Responses;

use Lvandi\OmnisendSDK\DTO\Paging;
use Lvandi\OmnisendSDK\DTO\Contact;
use Psr\Http\Message\ResponseInterface;

class GetContactsListResponse extends BaseResponse
{
    /** @var array<Contact> */
    private array $contacts = [];

    private Paging $paging;

    public function __construct(ResponseInterface $response)
    {
        parent::__construct($response);

        /** @var \stdClass $body */
        $body = json_decode($response->getBody());

        if (! empty($body->contacts)) {
            foreach ($body->contacts as $contact) {
                $this->contacts[] = Contact::fromRawData($contact);
            }
        }

        $this->paging = new Paging($body->paging);
    }

    /**
     * @return array<Contact>
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
