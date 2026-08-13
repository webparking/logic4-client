<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Responses\V30;

class CreditorOutstandingPost
{
    public function __construct(
        public ?int $id,
        public ?int $creditorId,
        public ?string $companyName,
        public ?string $reference,
        public ?string $date,
        public ?string $payBefore,
        public float $amountPaid,
        public float $amountOpen,
        public ?int $paymentMethodId,
        public ?string $description,
        public ?string $type,
        public ?int $statusId,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            id: $data['Id'] ?? null,
            creditorId: $data['CreditorId'] ?? null,
            companyName: $data['CompanyName'] ?? null,
            reference: $data['Reference'] ?? null,
            date: $data['Date'] ?? null,
            payBefore: $data['PayBefore'] ?? null,
            amountPaid: $data['AmountPaid'] ?? 0.0,
            amountOpen: $data['AmountOpen'] ?? 0.0,
            paymentMethodId: $data['PaymentMethodId'] ?? null,
            description: $data['Description'] ?? null,
            type: $data['Type'] ?? null,
            statusId: $data['StatusId'] ?? null,
        );
    }
}
