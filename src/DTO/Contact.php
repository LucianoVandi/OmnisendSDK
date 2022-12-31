<?php

namespace Lvandi\OmnisendSDK\DTO;

use stdClass;
use InvalidArgumentException;

class Contact implements \JsonSerializable
{
    use JsonSerializeTrait;

    public const IDENTIFIERS_TYPE = ['email', 'sms'];

    private ?string $contactID;

    private ?string $email;

    /** @var Identifier[] */
    private array $identifiers;

    private ?string $firstName = null;

    private ?string $lastName = null;

    private ?string $country = null;

    private ?string $countryCode = null;

    private ?string $state = null;

    private ?string $city = null;

    private ?string $address = null;

    private ?string $postalCode = null;

    // m - male, f- female
    private ?string $gender = null;

    private ?string $phone = null;

    private ?string $phoneNumber = null;

    private ?string $status = null;

    /** @var array<stdClass>|null */
    private ?array $statuses = null;

    private ?string $birthdate = null;

    /** @var array<stdClass>|null */
    private ?array $optIns = null;

    /** @var array<stdClass>|null */
    private ?array $doubleOptIns = null;

    private ?int $sent = null;

    private ?int $opened = null;

    private ?int $clicked = null;

    // Create only
    private bool $sendWelcomeEmail = false;

    private ?stdClass $customProperties = null;

    private ?array $segments = null;

    /**
     * Tags are labels you create to organize and manage your audience.
     * When creating a new contact we strongly advice to add source tag, i.e. "source: shopify"
     * @var string[]
     */
    private ?array $tags = null;

    /**
     * @param array|object $data
     * @return Contact
     */
    public static function fromRawData($data): Contact
    {
        if (is_array($data)) {
            $data = json_decode(
                (string) json_encode($data)
            );
        } elseif (! is_object($data)) {
            throw new InvalidArgumentException('Argument must be either an array or object.');
        }

        $contact = new self();

        $contact->setContactID($data->contactID ?? null)
            ->setEmail($data->email ?? null)
            ->setFirstName($data->firstName ?? null)
            ->setLastName($data->lastName ?? null)
            ->setCountry($data->country ?? null)
            ->setCountryCode($data->countryCode ?? null)
            ->setState($data->state ?? null)
            ->setCity($data->city ?? null)
            ->setPostalCode($data->postalCode ?? null)
            ->setAddress($data->address ?? null)
            ->setGender($data->gender ?? null)
            ->setPhone($data->phone ?? null)
            ->setPhoneNumber($data->phoneNumber ?? null)
            ->setBirthdate($data->birthdate ?? null)
            ->setStatus($data->status ?? null)
            ->setStatuses($data->statuses ?? null)
            ->setTags($data->tags ?? null)
            ->setSegments($data->segments ?? null)
            ->setCustomProperties($data->customProperties ?? null)
            ->setOptIns($data->optIns ?? null)
            ->setDoubleOptIns($data->doubleOptIns ?? null)
            ->setSent($data->sent ?? null)
            ->setOpened($data->opened ?? null)
            ->setClicked($data->clicked ?? null);

        if (isset($data->identifiers)) {
            $i = 0;
            $identifiers = [];

            foreach ($data->identifiers as $identifier) {
                $type = $identifier->type;

                if (! in_array($type, self::IDENTIFIERS_TYPE)) {
                    continue;
                }

                $channelType = $identifier->channels->$type;

                $channelObject = new ChannelObject();
                $channelObject->setStatus($channelType->status)
                    ->setStatusDate($channelType->statusDate ?? null);

                $channel = new Channel();
                $typeSetter = 'set'.ucfirst($type);
                $channel->$typeSetter($channelObject);

                $identifiers[$i] = new Identifier();
                $identifiers[$i]->setId($identifier->id)
                    ->setType($type)
                    ->setChannels($channel);

                $i++;
            }

            $contact->setIdentifiers($identifiers);
        }

        return $contact;
    }

    /**
     * @return array
     */
    public function getIdentifiers(): array
    {
        return $this->identifiers;
    }

    /**
     * @param array $identifiers
     * @return Contact
     */
    public function setIdentifiers(array $identifiers): Contact
    {
        $this->identifiers = $identifiers;

        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string|null $firstName
     * @return $this
     */
    public function setFirstName(?string $firstName): Contact
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string|null $lastName
     * @return $this
     */
    public function setLastName(?string $lastName): Contact
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @param string|null $country
     * @return Contact
     */
    public function setCountry(?string $country): Contact
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    /**
     * @param string|null $countryCode
     * @return Contact
     */
    public function setCountryCode(?string $countryCode): Contact
    {
        $this->countryCode = $countryCode;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getState(): ?string
    {
        return $this->state;
    }

    /**
     * @param string|null $state
     * @return Contact
     */
    public function setState(?string $state): Contact
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string|null $city
     * @return Contact
     */
    public function setCity(?string $city): Contact
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param string|null $address
     * @return Contact
     */
    public function setAddress(?string $address): Contact
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    /**
     * @param string|null $postalCode
     * @return Contact
     */
    public function setPostalCode(?string $postalCode): Contact
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getGender(): ?string
    {
        return $this->gender;
    }

    /**
     * @param string|null $gender
     * @return Contact
     */
    public function setGender(?string $gender): Contact
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getBirthdate(): ?string
    {
        return $this->birthdate;
    }

    /**
     * @param string|null $birthdate
     * @return Contact
     */
    public function setBirthdate(?string $birthdate): Contact
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * @return bool
     */
    public function isSendWelcomeEmail(): bool
    {
        return $this->sendWelcomeEmail;
    }

    /**
     * @param bool $sendWelcomeEmail
     * @return Contact
     */
    public function setSendWelcomeEmail(bool $sendWelcomeEmail = false): Contact
    {
        $this->sendWelcomeEmail = $sendWelcomeEmail;

        return $this;
    }

    /**
     * @return stdClass|null
     */
    public function getCustomProperties(): ?stdClass
    {
        return $this->customProperties;
    }

    /**
     * @param stdClass|null $customProperties
     * @return Contact
     */
    public function setCustomProperties(?stdClass $customProperties): Contact
    {
        $this->customProperties = $customProperties;

        return $this;
    }

    /**
     * @return array
     */
    public function getTags(): ?array
    {
        return $this->tags;
    }

    /**
     * @param ?array $tags
     * @return Contact
     */
    public function setTags(?array $tags): Contact
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getContactID(): ?string
    {
        return $this->contactID;
    }

    /**
     * @param string|null $contactID
     * @return Contact
     */
    public function setContactID(?string $contactID): Contact
    {
        $this->contactID = $contactID;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     * @return Contact
     */
    public function setEmail(?string $email): Contact
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string|null $phone
     * @return Contact
     */
    public function setPhone(?string $phone): Contact
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    /**
     * @param string|null $phoneNumber
     * @return Contact
     */
    public function setPhoneNumber(?string $phoneNumber): Contact
    {
        $this->phoneNumber = $phoneNumber;

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
     * @return Contact
     */
    public function setStatus(?string $status): Contact
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return array<stdClass>|null
     */
    public function getStatuses(): ?array
    {
        return $this->statuses;
    }

    /**
     * @param array<stdClass>|null $statuses
     * @return Contact
     */
    public function setStatuses(?array $statuses): Contact
    {
        $this->statuses = $statuses;

        return $this;
    }

    /**
     * @return array<stdClass>|null
     */
    public function getOptIns(): ?array
    {
        return $this->optIns;
    }

    /**
     * @param array<stdClass>|null $optIns
     * @return Contact
     */
    public function setOptIns(?array $optIns): Contact
    {
        $this->optIns = $optIns;

        return $this;
    }

    /**
     * @return array<stdClass>|null
     */
    public function getDoubleOptIns(): ?array
    {
        return $this->doubleOptIns;
    }

    /**
     * @param array<stdClass>|null $doubleOptIns
     * @return Contact
     */
    public function setDoubleOptIns(?array $doubleOptIns): Contact
    {
        $this->doubleOptIns = $doubleOptIns;

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
     * @return Contact
     */
    public function setSent(?int $sent): Contact
    {
        $this->sent = $sent;

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
     * @return Contact
     */
    public function setOpened(?int $opened): Contact
    {
        $this->opened = $opened;

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
     * @return Contact
     */
    public function setClicked(?int $clicked): Contact
    {
        $this->clicked = $clicked;

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
     * @return Contact
     */
    public function setSegments(?array $segments): Contact
    {
        $this->segments = $segments;

        return $this;
    }
}
