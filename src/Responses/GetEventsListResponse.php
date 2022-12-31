<?php

namespace Lvandi\OmnisendSDK\Responses;

use Lvandi\OmnisendSDK\DTO\Event;
use Psr\Http\Message\ResponseInterface;

class GetEventsListResponse extends BaseResponse
{
    /** @var array<Event> */
    private array $events = [];

    public function __construct(ResponseInterface $response)
    {
        parent::__construct($response);

        /** @var array<\stdClass> $body */
        $body = json_decode($response->getBody());

        if (! empty($body)) {
            foreach ($body as $event) {
                $this->events[] = new Event($event);
            }
        }
    }

    /**
     * @return array<Event>
     */
    public function getEvents(): array
    {
        return $this->events;
    }
}
