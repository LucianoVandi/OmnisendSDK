<?php

namespace Lvandi\OmnisendSDK\Responses;

use Lvandi\OmnisendSDK\Types\Contact;
use Psr\Http\Message\ResponseInterface;

class CreateContactResponse extends BaseResponse
{
    private Contact $contact;

    public function __construct(ResponseInterface $response)
    {
        parent::__construct($response);

        $body = json_decode($response->getBody());

        $this->contact = Contact::fromRawData($body);
    }

    /**
     * @return Contact
     */
    public function getContact(): Contact
    {
        return $this->contact;
    }
}
