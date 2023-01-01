<?php

namespace Lvandi\OmnisendSDK\Resources;

use Lvandi\OmnisendSDK\Responses\GetEventResponse;
use Lvandi\OmnisendSDK\Responses\TriggerEventResponse;
use Lvandi\OmnisendSDK\Responses\GetEventsListResponse;

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
     * @return GetEventResponse
     */
    public function get(string $eventId): GetEventResponse
    {
        $uri = $this->endpoint . '/' . $eventId;

        $response = $this->httpClient->sendRequest($uri, 'GET');

        return new GetEventResponse($response);
    }

    /**
     * Get a list of custom events created in Omnisend app.
     *
     * @return GetEventsListResponse
     */
    public function list(): GetEventsListResponse
    {
        $response = $this->httpClient->sendRequest($this->endpoint, 'GET');

        return new GetEventsListResponse($response);
    }

    /**
     * Trigger custom event to Omnisend.
     *
     * @param string $eventId
     * @param array $params
     * @return TriggerEventResponse
     */
    public function trigger(string $eventId, array $params): TriggerEventResponse
    {
        $uri = $this->endpoint . '/' . $eventId;

        $response = $this->httpClient->sendRequest($uri, 'POST', [
            'body' => json_encode([
                'email' => $params['email'],
                'fields' => $params['fields'],
            ]),
        ]);

        return new TriggerEventResponse($response);
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
