<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V10;

class AssemblyAction
{
    public function __construct(
        public ?\Carbon\Carbon $dateTime,
        public ?int $orderId,
        public ?int $orderRowId,
        public int $userId,
        public ?string $productCode,
        public ?float $amount,
        public ?int $stockLocationId,
        public ?string $description,
        public int $typeId,
        public ?string $typeDescription,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            dateTime: isset($data['DateTime']) ? \Carbon\Carbon::parse($data['DateTime']) : null,
            orderId: $data['OrderId'] ?? null,
            orderRowId: $data['OrderRowId'] ?? null,
            userId: $data['UserId'] ?? 0,
            productCode: $data['ProductCode'] ?? null,
            amount: $data['Amount'] ?? null,
            stockLocationId: $data['StockLocationId'] ?? null,
            description: $data['Description'] ?? null,
            typeId: $data['TypeId'] ?? 0,
            typeDescription: $data['TypeDescription'] ?? null,
        );
    }
}
