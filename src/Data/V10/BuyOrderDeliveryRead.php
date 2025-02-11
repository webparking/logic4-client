<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V10;

class BuyOrderDeliveryRead
{
    /** @param array<BuyOrderDeliveryRowRead> $rows */
    public function __construct(
        public int $buyOrderDeliveryId,
        public ?\Carbon\Carbon $dateTimeCreated,
        public ?\Carbon\Carbon $dateTimeProcessed,
        public int $statusId,
        public int $typeId,
        public ?int $supplierId,
        public ?int $buyOrderId,
        public ?string $remarks,
        public ?string $description,
        public ?int $branchId,
        public array $rows,
        public ?string $pickingListNumber,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            buyOrderDeliveryId: $data['BuyOrderDeliveryId'] ?? 0,
            dateTimeCreated: isset($data['DateTimeCreated']) ? \Carbon\Carbon::parse($data['DateTimeCreated']) : null,
            dateTimeProcessed: isset($data['DateTimeProcessed']) ? \Carbon\Carbon::parse($data['DateTimeProcessed']) : null,
            statusId: $data['StatusId'] ?? 0,
            typeId: $data['TypeId'] ?? 0,
            supplierId: $data['SupplierId'] ?? null,
            buyOrderId: $data['BuyOrderId'] ?? null,
            remarks: $data['Remarks'] ?? null,
            description: $data['Description'] ?? null,
            branchId: $data['BranchId'] ?? null,
            rows: array_map(static fn (array $item) => BuyOrderDeliveryRowRead::make($item), $data['Rows'] ?? []),
            pickingListNumber: $data['PickingListNumber'] ?? null,
        );
    }
}
