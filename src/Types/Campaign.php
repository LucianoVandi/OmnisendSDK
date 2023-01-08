<?php

declare(strict_types=1);

namespace Lvandi\OmnisendSDK\Types;

use JsonSerializable;
use InvalidArgumentException;

class Campaign implements JsonSerializable
{
    use JsonSerializeTrait;

    public const STATUS_DRAFT = 'draft';
    public const STATUS_PAUSED = 'paused';
    public const STATUS_SCHEDULED = 'scheduled';
    public const STATUS_IN_PROGRESS = 'inProgress';
    public const STATUS_SENT = 'sent';

    public const STATUSES = [
        self::STATUS_DRAFT,
        self::STATUS_PAUSED,
        self::STATUS_SCHEDULED,
        self::STATUS_IN_PROGRESS,
        self::STATUS_SENT,
    ];

    public const TYPE_STANDARD = 'standard';
    public const TYPE_AB_TEST = 'abTest';

    public const TYPES = [
        self::TYPE_STANDARD,
        self::TYPE_AB_TEST,
    ];

    public const SORT_SENT = 'sent';
    public const SORT_CLICKED = 'clicked';
    public const SORT_BOUNCED = 'bounced';
    public const SORT_COMPLAINED = 'complained';
    public const SORT_OPENED = 'opened';
    public const SORT_UNSUBSCRIBED = 'unsubscribed';

    // todo: rename to SORT_OPTIONS
    public const SORT_TYPES = [
        self::SORT_SENT,
        self::SORT_CLICKED,
        self::SORT_BOUNCED,
        self::SORT_COMPLAINED,
        self::SORT_OPENED,
        self::SORT_UNSUBSCRIBED,
    ];

    private string $campaignID;

    private ?string $name;

    private ?string $status;

    private ?string $type;

    private ?string $fromName;

    private ?string $subject;

    private ?string $url;

    private ?string $createdAt;

    private ?string $updatedAt;

    private ?string $startDate;

    private ?string $endDate;

    private ?int $sent;

    private ?int $clicked;

    private ?int $bounced;

    private ?int $complained;

    private ?int $opened;

    private ?int $unsubscribed;

    private ?bool $allSubscribers;

    /** @var array<Segment>|null */
    private ?array $segments;

    private ?AbTest $abTestWinner;

    /** @var array<AbTest>|null */
    private ?array $abTest;

    private ?StatByDevice $byDevices;

    /**
     * @param array|object $data
     * @return Campaign
     */
    public static function fromRawData($data): Campaign
    {
        if (is_array($data)) {
            $data = json_decode(
                (string) json_encode($data)
            );
        } elseif (! is_object($data)) {
            throw new InvalidArgumentException('Argument must be either an array or object.');
        }

        $campaign = new self();

        $campaign->setCampaignID($data->campaignID)
            ->setName($data->name)
            ->setStatus($data->status)
            ->setType($data->type)
            ->setFromName($data->fromName)
            ->setSubject($data->subject)
            ->setUrl($data->url)
            ->setCreatedAt($data->createdAt)
            ->setUpdatedAt($data->updatedAt)
            ->setStartDate($data->startDate)
            ->setEndDate($data->endDate)
            ->setSent($data->sent)
            ->setOpened($data->opened)
            ->setClicked($data->clicked)
            ->setBounced($data->bounced)
            ->setComplained($data->complained)
            ->setUnsubscribed($data->unsubscribed)
            ->setAllSubscribers($data->allSubscribers);

        if (! empty($data->segments)) {
            $segments = [];
            foreach ($data->segments as $segment) {
                $segments[] = new Segment($segment);
            }

            $campaign->setSegments($segments);
        }

        if (! empty($data->abTest)) {
            $abTests = [];
            foreach ($data->abTest as $abTest) {
                $abTests[] = new Segment($abTest);
            }

            $campaign->setAbTest($abTests);
        }

        if (isset($data->abTestWinner)) {
            $campaign->setAbTestWinner(new AbTest($data->abTestWinner));
        }

        if (isset($data->byDevices)) {
            $campaign->setByDevices(new StatByDevice($data->byDevices));
        }

        return $campaign;
    }

    /**
     * @return string
     */
    public function getCampaignID(): string
    {
        return $this->campaignID;
    }

    /**
     * @param string $campaignID
     * @return Campaign
     */
    public function setCampaignID(string $campaignID): Campaign
    {
        $this->campaignID = $campaignID;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return Campaign
     */
    public function setName(?string $name): Campaign
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     * @return Campaign
     */
    public function setStatus(?string $status): Campaign
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     * @return Campaign
     */
    public function setType(?string $type): Campaign
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFromName(): ?string
    {
        return $this->fromName;
    }

    /**
     * @param string|null $fromName
     * @return Campaign
     */
    public function setFromName(?string $fromName): Campaign
    {
        $this->fromName = $fromName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSubject(): ?string
    {
        return $this->subject;
    }

    /**
     * @param string|null $subject
     * @return Campaign
     */
    public function setSubject(?string $subject): Campaign
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string|null $url
     * @return Campaign
     */
    public function setUrl(?string $url): Campaign
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    /**
     * @param string|null $createdAt
     * @return Campaign
     */
    public function setCreatedAt(?string $createdAt): Campaign
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt;
    }

    /**
     * @param string|null $updatedAt
     * @return Campaign
     */
    public function setUpdatedAt(?string $updatedAt): Campaign
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getStartDate(): ?string
    {
        return $this->startDate;
    }

    /**
     * @param string|null $startDate
     * @return Campaign
     */
    public function setStartDate(?string $startDate): Campaign
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEndDate(): ?string
    {
        return $this->endDate;
    }

    /**
     * @param string|null $endDate
     * @return Campaign
     */
    public function setEndDate(?string $endDate): Campaign
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getSent(): ?int
    {
        return $this->sent;
    }

    /**
     * @param int|null $sent
     * @return Campaign
     */
    public function setSent(?int $sent): Campaign
    {
        $this->sent = $sent;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getClicked(): ?int
    {
        return $this->clicked;
    }

    /**
     * @param int|null $clicked
     * @return Campaign
     */
    public function setClicked(?int $clicked): Campaign
    {
        $this->clicked = $clicked;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getBounced(): ?int
    {
        return $this->bounced;
    }

    /**
     * @param int|null $bounced
     * @return Campaign
     */
    public function setBounced(?int $bounced): Campaign
    {
        $this->bounced = $bounced;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getComplained(): ?int
    {
        return $this->complained;
    }

    /**
     * @param int|null $complained
     * @return Campaign
     */
    public function setComplained(?int $complained): Campaign
    {
        $this->complained = $complained;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getOpened(): ?int
    {
        return $this->opened;
    }

    /**
     * @param int|null $opened
     * @return Campaign
     */
    public function setOpened(?int $opened): Campaign
    {
        $this->opened = $opened;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getUnsubscribed(): ?int
    {
        return $this->unsubscribed;
    }

    /**
     * @param int|null $unsubscribed
     * @return Campaign
     */
    public function setUnsubscribed(?int $unsubscribed): Campaign
    {
        $this->unsubscribed = $unsubscribed;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getAllSubscribers(): ?bool
    {
        return $this->allSubscribers;
    }

    /**
     * @param bool|null $allSubscribers
     * @return Campaign
     */
    public function setAllSubscribers(?bool $allSubscribers): Campaign
    {
        $this->allSubscribers = $allSubscribers;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getSegments(): ?array
    {
        return $this->segments;
    }

    /**
     * @param array|null $segments
     * @return Campaign
     */
    public function setSegments(?array $segments): Campaign
    {
        $this->segments = $segments;

        return $this;
    }

    /**
     * @return AbTest|null
     */
    public function getAbTestWinner(): ?AbTest
    {
        return $this->abTestWinner;
    }

    /**
     * @param AbTest|null $abTestWinner
     * @return Campaign
     */
    public function setAbTestWinner(?AbTest $abTestWinner): Campaign
    {
        $this->abTestWinner = $abTestWinner;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getAbTest(): ?array
    {
        return $this->abTest;
    }

    /**
     * @param array|null $abTest
     * @return Campaign
     */
    public function setAbTest(?array $abTest): Campaign
    {
        $this->abTest = $abTest;

        return $this;
    }

    /**
     * @return StatByDevice|null
     */
    public function getByDevices(): ?StatByDevice
    {
        return $this->byDevices;
    }

    /**
     * @param StatByDevice|null $byDevices
     * @return Campaign
     */
    public function setByDevices(?StatByDevice $byDevices): Campaign
    {
        $this->byDevices = $byDevices;

        return $this;
    }
}
