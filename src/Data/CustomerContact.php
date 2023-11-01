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
            emailAddress: $data['EmailAddress'],
            firstName: $data['FirstName'],
            function: $data['Function'],
            gender: $data['Gender'] ? Gender::make($data['Gender']) : null,
            initials: $data['Initials'],
            insertionName: $data['InsertionName'],
            lastName: $data['LastName'],
            mobileNumber: $data['MobileNumber'],
            createdDateTime: $data['CreatedDateTime'] ? Carbon::parse($data['CreatedDateTime']) : null,
            changedDateTime: $data['ChangedDateTime'] ? Carbon::parse($data['ChangedDateTime']) : null,
            id: $data['Id'],
            debtorId: $data['DebtorId'],
            creditorId: $data['CreditorId'],
            isMainContact: $data['IsMainContact'],
            isHidden: $data['IsHidden'],
            ownContactNumber: $data['OwnContactNumber'],
            countryCode: $data['CountryCode'],
            isoCode: $data['IsoCode'],
            city: $data['City'],
            zipcode: $data['Zipcode'],
            street: $data['Street'],
            houseNumber: $data['HouseNumber'],
            houseNumberAddition: $data['HouseNumberAddition'],
            telephoneNumber: $data['TelephoneNumber'],
            countryId: $data['CountryId'],
            zoneId: $data['ZoneId'],
        );
    }
}
