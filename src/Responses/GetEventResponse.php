<?php

namespace Lvandi\OmnisendSDK\Responses;

use Lvandi\OmnisendSDK\Types\Event;
use Psr\Http\Message\ResponseInterface;

class GetEventResponse extends BaseResponse
{
    private Event $event;

    public function __construct(ResponseInterface $response)
    {
        parent::__construct($response);

        $body = $this->getDecodedBody();

        $this->event = new Event($body);
    }

    /**
     * @return Event
     */
    public function getEvent(): Event
    {
        return $this->event;
    }
}
