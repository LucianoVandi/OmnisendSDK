<?php

namespace Lvandi\OmnisendSDK\DTO;

use InvalidArgumentException;

class Address implements \JsonSerializable
{
    use JsonSerializeTrait;

    public ?string $firstName;

    public ?string $lastName;

    public ?string $company;

    public ?string $phone;

    public ?string $country;

    public ?string $countryCode;

    public ?string $state;

    public ?string $stateCode;

    public ?string $city;

    public ?string $address;

    public ?string $address2;

    public ?string $postalCode;

}
