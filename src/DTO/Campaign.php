<?php

namespace Lvandi\OmnisendSDK\DTO;

use InvalidArgumentException;

class Campaign implements \JsonSerializable
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
        self::STATUS_SENT
    ];

    public const TYPE_STANDARD = 'standard';
    public const TYPE_AB_TEST = 'abTest';

    public const TYPES = [
        self::TYPE_STANDARD,
        self::TYPE_AB_TEST
    ];

    private string $campaignID;

    private ?string $name;

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

    private ?array $segments;

    private ?array $abTestWinner;

    private ?array $abTest;


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

        return $campaign;
    }
}
