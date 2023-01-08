<?php

declare(strict_types=1);

namespace Lvandi\OmnisendSDK\Resources;

use Exception;
use Lvandi\OmnisendSDK\Types\Contact;
use Lvandi\OmnisendSDK\Responses\ContactResponse;
use Lvandi\OmnisendSDK\Responses\ContactsListResponse;
use Lvandi\OmnisendSDK\Exceptions\MissingRequiredPropertyException;

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
     * @return ContactResponse
     */
    public function get(string $contactId): ContactResponse
    {
        $uri = $this->endpoint . '/' . $contactId;

        $response = $this->httpClient->sendRequest($uri, 'GET');

        return new ContactResponse($response);
    }

    /**
     * Get a paginated list of contacts.
     * Result can be filtered by: email, status, segmentID, tag, phone.
     *
     * @param array|null $filters
     * @param int|null $limit default 100, max 250
     * @return ContactsListResponse
     * @throws Exception
     */
    public function list(?array $filters = null, ?int $limit = 100): ContactsListResponse
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

        return new ContactsListResponse($response);
    }

    /**
     * Create a new contact.
     *
     * @param Contact $contact
     * @return ContactResponse
     */
    public function create(Contact $contact): ContactResponse
    {
        $response = $this->httpClient->sendRequest($this->endpoint, 'POST', [
            'body' => json_encode($contact),
        ]);

        return new ContactResponse($response);
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
     * @return ContactResponse
     * @throws MissingRequiredPropertyException
     */
    public function update(Contact $contact, ?string $email, ?string $contactId = null): ContactResponse
    {
        $uri = $this->endpoint;
        $options['body'] = json_encode($contact);

        if (! is_null($contactId)) {
            $uri .= '/' . $contactId;
        } elseif (! is_null($email)) {
            $options['query']['email'] = $email;
        } else {
            throw new MissingRequiredPropertyException('Contact ID or Email must be supplied!');
        }

        $response = $this->httpClient->sendRequest($uri, 'PATCH', $options);

        return new ContactResponse($response);
    }
}
