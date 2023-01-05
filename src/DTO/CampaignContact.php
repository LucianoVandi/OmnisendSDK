<?php

namespace Lvandi\OmnisendSDK\DTO;

class CampaignContact implements \JsonSerializable
{
    use JsonSerializeTrait;

    private ?string $email;

    private ?string $contactID;

    private ?bool $sent;

    private ?bool $opened;

    private ?bool $clicked;

    private ?bool $bounced;

    private ?bool $complained;

    private ?bool $unsubscribed;

    public function __construct(\stdClass $contact)
    {
        $this->email = $contact->email;
        $this->contactID = $contact->contactID;
        $this->sent = $contact->sent;
        $this->opened = $contact->opened;
        $this->clicked = $contact->clicked;
        $this->bounced = $contact->bounced;
        $this->complained = $contact->complained;
        $this->unsubscribed = $contact->unsubscribed;
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
