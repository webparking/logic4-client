<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

class CustomerAddress
{
    public function __construct(
        public ?AddressType $type,
        public ?Province $province,
        public ?string $email,
        public ?string $contactName,
        public ?string $companyName,
        public ?string $address1,
        public ?string $address2,
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
            type: $data['Type'] ? AddressType::make($data['Type']) : null,
            province: $data['Province'] ? Province::make($data['Province']) : null,
            email: $data['Email'],
            contactName: $data['ContactName'],
            companyName: $data['CompanyName'],
            address1: $data['Address1'],
            address2: $data['Address2'],
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
