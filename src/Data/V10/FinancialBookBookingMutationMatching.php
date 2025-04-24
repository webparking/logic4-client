<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V10;

class FinancialBookBookingMutationMatching
{
    public function __construct(
        public float $amount,
        public ?int $orderId,
        public int $ledgerId,
        public int $vatCode,
        public ?string $description,
        public float $vatAmount,
        public float $exclVatAmount,
        public float $inclVatAmount,
        public ?int $financialCostCenterId,
        public ?int $productId,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            amount: $data['Amount'] ?? 0.0,
            orderId: $data['OrderId'] ?? null,
            ledgerId: $data['LedgerId'] ?? 0,
            vatCode: $data['VatCode'] ?? 0,
            description: $data['Description'] ?? null,
            vatAmount: $data['VatAmount'] ?? 0.0,
            exclVatAmount: $data['ExclVatAmount'] ?? 0.0,
            inclVatAmount: $data['InclVatAmount'] ?? 0.0,
            financialCostCenterId: $data['FinancialCostCenterId'] ?? null,
            productId: $data['ProductId'] ?? null,
        );
    }
}
