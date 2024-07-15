<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V11;

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
            companyName: $data['CompanyName'] ?? null,
            emailAddress: $data['EmailAddress'] ?? null,
            faxnumber: $data['Faxnumber'] ?? null,
            firstName: $data['FirstName'] ?? null,
            id: $data['Id'] ?? 0,
            lastName: $data['LastName'] ?? null,
            mobileNumber: $data['MobileNumber'] ?? null,
            telephoneNumber: $data['TelephoneNumber'] ?? null,
        );
    }
}
