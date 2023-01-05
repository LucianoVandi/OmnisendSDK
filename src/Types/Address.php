<?php

namespace Lvandi\OmnisendSDK\Types;

class Address implements \JsonSerializable
{
    use JsonSerializeTrait;

    private ?string $firstName;

    private ?string $lastName;

    private ?string $company;

    private ?string $phone;

    private ?string $country;

    private ?string $countryCode;

    private ?string $state;

    private ?string $stateCode;

    private ?string $city;

    private ?string $address;

    private ?string $address2;

    private ?string $postalCode;

    public function __construct(\stdClass $address)
    {
        $this->firstName = $address->firstName;
        $this->lastName = $address->lastName;
        $this->company = $address->company;
        $this->phone = $address->phone;
        $this->country = $address->country;
        $this->countryCode = $address->countryCode;
        $this->state = $address->state;
        $this->stateCode = $address->stateCode;
        $this->city = $address->city;
        $this->address = $address->address;
        $this->address2 = $address->address2;
        $this->postalCode = $address->postalCode;
    }

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @return string|null
     */
    public function getCompany(): ?string
    {
        return $this->company;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @return string|null
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @return string|null
     */
    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    /**
     * @return string|null
     */
    public function getState(): ?string
    {
        return $this->state;
    }

    /**
     * @return string|null
     */
    public function getStateCode(): ?string
    {
        return $this->stateCode;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @return string|null
     */
    public function getAddress2(): ?string
    {
        return $this->address2;
    }

    /**
     * @return string|null
     */
    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }
}
