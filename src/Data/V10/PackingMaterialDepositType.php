<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V10;

class PackingMaterialDepositType
{
    public function __construct(
        public int $id,
        public ?string $description,
        public float $price,
        public ?int $returnProductId,
        public ?int $purchasesLedgerId,
        public ?int $salesLedgerId,
        public ?int $stockLedgerId,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            id: $data['Id'] ?? 0,
            description: $data['Description'] ?? null,
            price: $data['Price'] ?? 0.0,
            returnProductId: $data['ReturnProductId'] ?? null,
            purchasesLedgerId: $data['PurchasesLedgerId'] ?? null,
            salesLedgerId: $data['SalesLedgerId'] ?? null,
            stockLedgerId: $data['StockLedgerId'] ?? null,
        );
    }
}
