<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V11;

class Creditor
{
    public function __construct(
        public ?string $address1,
        public ?string $address2,
        public ?string $address3,
        public ?string $city,
        public ?string $companyName,
        public int $countryId,
        public ?string $emailAddress,
        public ?string $faxnumber,
        public ?string $firstName,
        public int $id,
        public ?string $kvkNumber,
        public ?string $lastName,
        public ?string $mobileNumber,
        public ?string $notes,
        public ?PaymentConditionDto $paymentCondition,
        public ?string $postalCode,
        public ?int $provinceId,
        public ?string $supplierGLN,
        public ?CreditorTypeDto $creditorType,
        public ?string $telephoneNumber,
        public ?string $vatNumber,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            address1: $data['Address1'] ?? null,
            address2: $data['Address2'] ?? null,
            address3: $data['Address3'] ?? null,
            city: $data['City'] ?? null,
            companyName: $data['CompanyName'] ?? null,
            countryId: $data['CountryId'] ?? 0,
            emailAddress: $data['EmailAddress'] ?? null,
            faxnumber: $data['Faxnumber'] ?? null,
            firstName: $data['FirstName'] ?? null,
            id: $data['Id'] ?? 0,
            kvkNumber: $data['KvkNumber'] ?? null,
            lastName: $data['LastName'] ?? null,
            mobileNumber: $data['MobileNumber'] ?? null,
            notes: $data['Notes'] ?? null,
            paymentCondition: isset($data['PaymentCondition']) ? PaymentConditionDto::make($data['PaymentCondition']) : null,
            postalCode: $data['PostalCode'] ?? null,
            provinceId: $data['ProvinceId'] ?? null,
            supplierGLN: $data['SupplierGLN'] ?? null,
            creditorType: isset($data['CreditorType']) ? CreditorTypeDto::make($data['CreditorType']) : null,
            telephoneNumber: $data['TelephoneNumber'] ?? null,
            vatNumber: $data['VatNumber'] ?? null,
        );
    }
}
