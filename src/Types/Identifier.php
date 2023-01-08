<?php

declare(strict_types=1);

namespace Lvandi\OmnisendSDK\Types;

use JsonSerializable;
use Lvandi\OmnisendSDK\Traits\JsonSerializeTrait;

class Identifier implements JsonSerializable
{
    use JsonSerializeTrait;

    private string $id;

    private string $type;

    private bool $sendWelcomeMessage = false;

    /**
     * @var Channel
     */
    private Channel $channels;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return Identifier
     */
    public function setId(string $id): Identifier
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Identifier
     */
    public function setType(string $type): Identifier
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return bool
     */
    public function isSendWelcomeMessage(): bool
    {
        return $this->sendWelcomeMessage;
    }

    /**
     * @param bool $sendWelcomeMessage
     * @return Identifier
     */
    public function setSendWelcomeMessage(bool $sendWelcomeMessage): Identifier
    {
        $this->sendWelcomeMessage = $sendWelcomeMessage;

        return $this;
    }

    /**
     * @return Channel
     */
    public function getChannels(): Channel
    {
        return $this->channels;
    }

    /**
     * @param Channel $channels
     * @return Identifier
     */
    public function setChannels(Channel $channels): Identifier
    {
        $this->channels = $channels;

        return $this;
    }
}
