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
            name: $data['Name'],
            address: $data['Address'],
            houseNumber: $data['HouseNumber'],
            zipcode: $data['Zipcode'],
            city: $data['City'],
            province: $data['Province'],
            country: $data['Country'],
            email: $data['Email'],
            telephone: $data['Telephone'],
            vatnumber: $data['Vatnumber'],
            kvknumber: $data['Kvknumber'],
            bankaccount: $data['Bankaccount'],
        );
    }
}
