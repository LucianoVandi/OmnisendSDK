<?php

namespace Lvandi\OmnisendSDK\Responses;

use Psr\Http\Message\ResponseInterface;

class CampaignContactResponse extends BaseResponse
{
    private ?string $email;

    private ?string $contactID;

    private ?bool $sent;

    private ?bool $opened;

    private ?bool $clicked;

    private ?bool $bounced;

    private ?bool $complained;

    private ?bool $unsubscribed;

    public function __construct(ResponseInterface $response)
    {
        parent::__construct($response);

        // 204 status code means empty response, then we set
        // the body to an empty array for custom response processing
        $body = $response->getStatusCode() !== 204
            ? json_decode($response->getBody())
            : [];

        if (is_object($body)) {
            /** @var \stdClass $body */
            $this->email = $body->email;
            $this->contactID = $body->contactID;
            $this->sent = $body->sent;
            $this->opened = $body->opened;
            $this->clicked = $body->clicked;
            $this->bounced = $body->bounced;
            $this->complained = $body->complained;
            $this->unsubscribed = $body->unsubscribed;
        }
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @return string|null
     */
    public function getContactID(): ?string
    {
        return $this->contactID;
    }

    /**
     * @return bool|null
     */
    public function getSent(): ?bool
    {
        return $this->sent;
    }

    /**
     * @return bool|null
     */
    public function getOpened(): ?bool
    {
        return $this->opened;
    }

    /**
     * @return bool|null
     */
    public function getClicked(): ?bool
    {
        return $this->clicked;
    }

    /**
     * @return bool|null
     */
    public function getBounced(): ?bool
    {
        return $this->bounced;
    }

    /**
     * @return bool|null
     */
    public function getComplained(): ?bool
    {
        return $this->complained;
    }

    /**
     * @return bool|null
     */
    public function getUnsubscribed(): ?bool
    {
        return $this->unsubscribed;
    }

}
