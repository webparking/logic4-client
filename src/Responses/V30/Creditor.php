<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Responses\V30;

class Creditor
{
    public function __construct(
        public ?string $address2,
        public ?string $address3,
        public int $countryId,
        public ?string $faxnumber,
        public ?string $firstName,
        public ?string $kvkNumber,
        public ?string $lastName,
        public ?string $mobileNumber,
        public ?string $notes,
        public ?\Webparking\Logic4Client\Data\V30\PaymentConditionDto $paymentCondition,
        public ?int $provinceId,
        public ?string $supplierGLN,
        public ?\Webparking\Logic4Client\Data\V30\CreditorTypeDto $creditorType,
        public ?string $telephoneNumber,
        public ?string $vatNumber,
        public ?string $bankAccount,
        public int $id,
        public ?string $companyName,
        public ?string $address1,
        public ?string $postalCode,
        public ?string $city,
        public ?string $emailAddress,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            address2: $data['Address2'] ?? null,
            address3: $data['Address3'] ?? null,
            countryId: $data['CountryId'] ?? 0,
            faxnumber: $data['Faxnumber'] ?? null,
            firstName: $data['FirstName'] ?? null,
            kvkNumber: $data['KvkNumber'] ?? null,
            lastName: $data['LastName'] ?? null,
            mobileNumber: $data['MobileNumber'] ?? null,
            notes: $data['Notes'] ?? null,
            paymentCondition: isset($data['PaymentCondition']) ? \Webparking\Logic4Client\Data\V30\PaymentConditionDto::make($data['PaymentCondition']) : null,
            provinceId: $data['ProvinceId'] ?? null,
            supplierGLN: $data['SupplierGLN'] ?? null,
            creditorType: isset($data['CreditorType']) ? \Webparking\Logic4Client\Data\V30\CreditorTypeDto::make($data['CreditorType']) : null,
            telephoneNumber: $data['TelephoneNumber'] ?? null,
            vatNumber: $data['VatNumber'] ?? null,
            bankAccount: $data['BankAccount'] ?? null,
            id: $data['Id'] ?? 0,
            companyName: $data['CompanyName'] ?? null,
            address1: $data['Address1'] ?? null,
            postalCode: $data['PostalCode'] ?? null,
            city: $data['City'] ?? null,
            emailAddress: $data['EmailAddress'] ?? null,
        );
    }
}
