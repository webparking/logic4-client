<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V13;

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
            type: isset($data['Type']) ? AddressType::make($data['Type']) : null,
            province: isset($data['Province']) ? Province::make($data['Province']) : null,
            email: $data['Email'] ?? null,
            contactName: $data['ContactName'] ?? null,
            companyName: $data['CompanyName'] ?? null,
            address1: $data['Address1'] ?? null,
            address2: $data['Address2'] ?? null,
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
