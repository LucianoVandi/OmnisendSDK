<?php

namespace Lvandi\OmnisendSDK\Resources;

use Lvandi\OmnisendSDK\DTO\Contact;
use Lvandi\OmnisendSDK\Responses\GetContactResponse;
use Lvandi\OmnisendSDK\Responses\CreateContactResponse;
use Lvandi\OmnisendSDK\Responses\UpdateContactResponse;
use Lvandi\OmnisendSDK\Responses\GetContactsListResponse;

class Contacts extends BaseResource
{
    private string $endpoint = 'contacts';

    protected array $listFilters = [
        'email',
        'phone',
        'status',
        'segmentID',
        'tag',
    ];

    /**
     * Get the contact details
     *
     * @param string $contactId
     * @return GetContactResponse
     */
    public function get(string $contactId): GetContactResponse
    {
        $uri = $this->endpoint . '/' . $contactId;

        $response = $this->httpClient->sendRequest($uri, 'GET');

        return new GetContactResponse($response);
    }

    /**
     * Get a paginated list of contacts.
     * Result can be filtered by: email, status, segmentID, tag, phone.
     *
     * @param array|null $filters
     * @param int|null $limit default 100, max 250
     * @return GetContactsListResponse
     * @throws \Exception
     */
    public function list(?array $filters = null, ?int $limit = 100): GetContactsListResponse
    {
        $queryParams = [
            'limit' => $limit,
        ];

        if (! empty($filters)) {
            $queryParams = array_merge($queryParams, $this->applyFilters($filters));
        }

        $response = $this->httpClient->sendRequest($this->endpoint, 'GET', [
            'query' => $queryParams,
        ]);

        return new GetContactsListResponse($response);
    }

    /**
     * Create a new contact.
     *
     * @param Contact $contact
     * @return CreateContactResponse
     */
    public function create(Contact $contact): CreateContactResponse
    {
        $response = $this->httpClient->sendRequest($this->endpoint, 'POST', [
            'body' => json_encode($contact),
        ]);

        return new CreateContactResponse($response);
    }

    /**
     * Update details of an existing contact.
     * Any field can be updated, except email (identifiers.id value for type email).
     * Phone (identifiers.id value for type phone) will be added/updated only if
     * it isn't assigned to another contact.
     *
     * @param Contact $contact Pass only fields you want to update.
     * @param string|null $email
     * @param string|null $contactId
     * @return UpdateContactResponse
     * @throws \Exception
     */
    public function update(Contact $contact, ?string $email, ?string $contactId = null): UpdateContactResponse
    {
        $uri = $this->endpoint;
        $options['body'] = json_encode($contact);

        if (! is_null($contactId)) {
            $uri .= '/' . $contactId;
        } elseif (! is_null($email)) {
            $options['query']['email'] = $email;
        } else {
            throw new \Exception('Contact ID or Email must be supplied!');
        }

        $response = $this->httpClient->sendRequest($uri, 'PATCH', $options);

        return new UpdateContactResponse($response);
    }
}
