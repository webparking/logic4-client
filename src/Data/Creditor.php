<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

class Creditor
{
    public function __construct(
        public ?string $companyName,
        public ?string $emailAddress,
        public ?string $faxnumber,
        public ?string $firstName,
        public int $id,
        public ?string $lastName,
        public ?string $mobileNumber,
        public ?string $telephoneNumber,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            companyName: $data['CompanyName'],
            emailAddress: $data['EmailAddress'],
            faxnumber: $data['Faxnumber'],
            firstName: $data['FirstName'],
            id: $data['Id'],
            lastName: $data['LastName'],
            mobileNumber: $data['MobileNumber'],
            telephoneNumber: $data['TelephoneNumber'],
        );
    }
}
