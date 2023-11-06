<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

class CompanyInformation
{
    public function __construct(
        public ?string $name,
        public ?string $address,
        public ?string $houseNumber,
        public ?string $zipcode,
        public ?string $city,
        public ?string $province,
        public ?string $country,
        public ?string $email,
        public ?string $telephone,
        public ?string $vatnumber,
        public ?string $kvknumber,
        public ?string $bankaccount,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            name: $data['Name'] ?? null,
            address: $data['Address'] ?? null,
            houseNumber: $data['HouseNumber'] ?? null,
            zipcode: $data['Zipcode'] ?? null,
            city: $data['City'] ?? null,
            province: $data['Province'] ?? null,
            country: $data['Country'] ?? null,
            email: $data['Email'] ?? null,
            telephone: $data['Telephone'] ?? null,
            vatnumber: $data['Vatnumber'] ?? null,
            kvknumber: $data['Kvknumber'] ?? null,
            bankaccount: $data['Bankaccount'] ?? null,
        );
    }
}
