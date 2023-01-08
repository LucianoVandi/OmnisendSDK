<?php

declare(strict_types=1);

namespace Lvandi\OmnisendSDK\Types;

use stdClass;
use JsonSerializable;
use Lvandi\OmnisendSDK\Traits\JsonSerializeTrait;

class AbTest implements JsonSerializable
{
    use JsonSerializeTrait;

    private ?bool $winner;

    private ?string $fromName;

    private ?string $subject;

    private ?string $startDate;

    private ?string $endDate;

    private ?int $sent;

    private ?int $clicked;

    private ?int $bounced;

    private ?int $complained;

    private ?int $opened;

    private ?int $unsubscribed;

    public function __construct(stdClass $abTest)
    {
        $this->winner = $abTest->winner;
        $this->fromName = $abTest->fromName;
        $this->subject = $abTest->subject;
        $this->startDate = $abTest->startDate;
        $this->endDate = $abTest->endDate;
        $this->sent = $abTest->sent;
        $this->clicked = $abTest->clicked;
        $this->bounced = $abTest->bounced;
        $this->complained = $abTest->complained;
        $this->opened = $abTest->opened;
        $this->unsubscribed = $abTest->unsubscribed;
    }

    /**
     * @return bool|null
     */
    public function getWinner(): ?bool
    {
        return $this->winner;
    }

    /**
     * @return string|null
     */
    public function getFromName(): ?string
    {
        return $this->fromName;
    }

    /**
     * @return string|null
     */
    public function getSubject(): ?string
    {
        return $this->subject;
    }

    /**
     * @return string|null
     */
    public function getStartDate(): ?string
    {
        return $this->startDate;
    }

    /**
     * @return string|null
     */
    public function getEndDate(): ?string
    {
        return $this->endDate;
    }

    /**
     * @return int|null
     */
    public function getSent(): ?int
    {
        return $this->sent;
    }

    /**
     * @return int|null
     */
    public function getClicked(): ?int
    {
        return $this->clicked;
    }

    /**
     * @return int|null
     */
    public function getBounced(): ?int
    {
        return $this->bounced;
    }

    /**
     * @return int|null
     */
    public function getComplained(): ?int
    {
        return $this->complained;
    }

    /**
     * @return int|null
     */
    public function getOpened(): ?int
    {
        return $this->opened;
    }

    /**
     * @return int|null
     */
    public function getUnsubscribed(): ?int
    {
        return $this->unsubscribed;
    }
}
