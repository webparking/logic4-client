<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

use Carbon\Carbon;

class CustomerContact
{
    public function __construct(
        public ?string $emailAddress,
        public ?string $firstName,
        public ?string $function,
        public ?Gender $gender,
        public ?string $initials,
        public ?string $insertionName,
        public ?string $lastName,
        public ?string $mobileNumber,
        public ?Carbon $createdDateTime,
        public ?Carbon $changedDateTime,
        public ?int $id,
        public ?int $debtorId,
        public ?int $creditorId,
        public bool $isMainContact,
        public ?bool $isHidden,
        public ?string $ownContactNumber,
        public ?string $countryCode,
        public ?string $isoCode,
        public ?string $city,
        public ?string $zipcode,
        public ?string $street,
        public ?string $houseNumber,
        public ?string $houseNumberAddition,
        public ?string $telephoneNumber,
        public int $countryId,
        public int $zoneId,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            emailAddress: $data['EmailAddress'] ?? null,
            firstName: $data['FirstName'] ?? null,
            function: $data['Function'] ?? null,
            gender: isset($data['Gender']) ? Gender::make($data['Gender']) : null,
            initials: $data['Initials'] ?? null,
            insertionName: $data['InsertionName'] ?? null,
            lastName: $data['LastName'] ?? null,
            mobileNumber: $data['MobileNumber'] ?? null,
            createdDateTime: isset($data['CreatedDateTime']) ? Carbon::parse($data['CreatedDateTime']) : null,
            changedDateTime: isset($data['ChangedDateTime']) ? Carbon::parse($data['ChangedDateTime']) : null,
            id: $data['Id'] ?? null,
            debtorId: $data['DebtorId'] ?? null,
            creditorId: $data['CreditorId'] ?? null,
            isMainContact: $data['IsMainContact'] ?? false,
            isHidden: $data['IsHidden'] ?? null,
            ownContactNumber: $data['OwnContactNumber'] ?? null,
            countryCode: $data['CountryCode'] ?? null,
            isoCode: $data['IsoCode'] ?? null,
            city: $data['City'] ?? null,
            zipcode: $data['Zipcode'] ?? null,
            street: $data['Street'] ?? null,
            houseNumber: $data['HouseNumber'] ?? null,
            houseNumberAddition: $data['HouseNumberAddition'] ?? null,
            telephoneNumber: $data['TelephoneNumber'] ?? null,
            countryId: $data['CountryId'] ?? 0,
            zoneId: $data['ZoneId'] ?? 0,
        );
    }
}
