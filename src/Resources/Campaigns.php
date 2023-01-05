<?php

namespace Lvandi\OmnisendSDK\Resources;

use Lvandi\OmnisendSDK\DTO\Campaign;
use Lvandi\OmnisendSDK\Responses\CampaignResponse;
use Lvandi\OmnisendSDK\Responses\CampaignListResponse;
use Lvandi\OmnisendSDK\Responses\CampaignContactResponse;
use Lvandi\OmnisendSDK\Responses\CampaignContactListResponse;

class Campaigns extends BaseResource
{
    private string $endpoint = 'campaigns';

    protected array $listFilters = [
        'status',
        'type',
    ];

    /**
     * Get campaign details
     *
     * @param string $campaignID
     * @return CampaignResponse
     */
    public function get(string $campaignID): CampaignResponse
    {
        $uri = $this->endpoint . '/' . $campaignID;

        $response = $this->httpClient->sendRequest($uri, 'GET');

        return new CampaignResponse($response);
    }

    /**
     * List campaigns
     *
     * @param array|null $filters
     * @param string|null $sort
     * @param int|null $limit
     * @param int|null $offset
     * @return CampaignListResponse
     * @throws \Exception
     */
    public function list(
        ?array $filters = null,
        ?string $sort = Campaign::SORT_OPENED,
        ?int $limit = 100,
        ?int $offset = 0
    ): CampaignListResponse {
        $queryParams = [
            'limit' => $limit,
            'offset' => $offset,
            'sort' => $sort,
        ];

        if (! empty($filters)) {
            $queryParams = array_merge($queryParams, $this->applyListFilters($filters));
        }

        $response = $this->httpClient->sendRequest($this->endpoint, 'GET', [
            'query' => $queryParams,
        ]);

        return new CampaignListResponse($response);
    }

    /**
     * Get campaign info for specific contact
     *
     * @param string $campaignID
     * @param string $contactID
     * @return CampaignContactResponse
     */
    public function getContact(string $campaignID, string $contactID): CampaignContactResponse
    {
        $uri = $this->endpoint . '/' . $campaignID . '/contacts/' . $contactID;

        $response = $this->httpClient->sendRequest($uri, 'GET');

        return new CampaignContactResponse($response);
    }

    /**
     * todo: manage filters
     * @param string $campaignID
     * @param array|null $filters
     * @param int|null $limit
     * @param int|null $offset
     * @return CampaignContactListResponse
     */
    public function listContacts(
        string $campaignID,
        ?array $filters = null,
        ?int $limit = 100,
        ?int $offset = 0
    ): CampaignContactListResponse {
        $uri = $this->endpoint . '/' . $campaignID . '/contacts';

        $queryParams = [
            'limit' => $limit,
            'offset' => $offset,
        ];

        if (! empty($filters)) {
            $queryParams = array_merge($queryParams, $this->applyListFilters($filters));
        }

        $response = $this->httpClient->sendRequest($uri, 'GET', [
            'query' => $queryParams,
        ]);

        return new CampaignContactListResponse($response);
    }

    /**
     * Delete a campaign
     *
     * @param string $campaignID
     * @return CampaignResponse
     */
    public function delete(string $campaignID): CampaignResponse
    {
        $uri = $this->endpoint . '/' . $campaignID;

        $response = $this->httpClient->sendRequest($uri, 'DELETE');

        return new CampaignResponse($response);
    }

    /**
     * Start sending campaign emails if campaign is in draft/scheduled mode.
     *
     * @param string $campaignID
     * @return CampaignResponse
     */
    public function startSending(string $campaignID): CampaignResponse
    {
        $uri = $this->endpoint . '/' . $campaignID . '/actions/start';

        $response = $this->httpClient->sendRequest($uri, 'POST');

        return new CampaignResponse($response);
    }
}
