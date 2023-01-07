<?php

namespace Lvandi\OmnisendSDK\Resources;

use Lvandi\OmnisendSDK\Responses\EventResponse;
use Lvandi\OmnisendSDK\Responses\EventListResponse;

/**
 * Custom events are used to trigger custom automation workflows through API.
 * All custom events can have custom fields for any type of additional information,
 * that should be used in the content of those automated emails.
 */
class Events extends BaseResource
{
    private string $endpoint = 'events';

    /**
     * Get custom event created in Omnisend app.
     *
     * @param string $eventId
     * @return EventResponse
     */
    public function get(string $eventId): EventResponse
    {
        $uri = $this->endpoint . '/' . $eventId;

        $response = $this->httpClient->sendRequest($uri, 'GET');

        return new EventResponse($response);
    }

    /**
     * Get a list of custom events created in Omnisend app.
     *
     * @return EventListResponse
     */
    public function list(): EventListResponse
    {
        $response = $this->httpClient->sendRequest($this->endpoint, 'GET');

        return new EventListResponse($response);
    }

    /**
     * Trigger custom event to Omnisend.
     *
     * @param string $eventId
     * @param array $params
     * @return EventResponse
     */
    public function trigger(string $eventId, array $params): EventResponse
    {
        $uri = $this->endpoint . '/' . $eventId;

        $response = $this->httpClient->sendRequest($uri, 'POST', [
            'body' => json_encode([
                'email' => $params['email'],
                'fields' => $params['fields'],
            ]),
        ]);

        return new EventResponse($response);
    }

    /**
     * Create a custom event in Omnisend app.
     *
     * @param string $name
     * @return void
     */
    public function create(string $name)
    {
        // @todo
    }
}
