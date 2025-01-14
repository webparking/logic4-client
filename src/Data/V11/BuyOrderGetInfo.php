<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V11;

class BuyOrderGetInfo
{
    public function __construct(
        public ?\Carbon\Carbon $lastChangedAt,
        public int $amountOfRows,
        public ?int $branchId,
        public bool $buyOrderClosed,
        public ?\Carbon\Carbon $createdAt,
        public ?string $creditorCompanyName,
        public int $creditorId,
        public int $databaseAdministrationId,
        public int $id,
        public ?int $orderId,
        public ?string $remarks,
        public ?string $freeValue1,
        public ?string $freeValue2,
        public ?string $freeValue3,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            lastChangedAt: isset($data['LastChangedAt']) ? \Carbon\Carbon::parse($data['LastChangedAt']) : null,
            amountOfRows: $data['AmountOfRows'] ?? 0,
            branchId: $data['BranchId'] ?? null,
            buyOrderClosed: $data['BuyOrderClosed'] ?? false,
            createdAt: isset($data['CreatedAt']) ? \Carbon\Carbon::parse($data['CreatedAt']) : null,
            creditorCompanyName: $data['CreditorCompanyName'] ?? null,
            creditorId: $data['CreditorId'] ?? 0,
            databaseAdministrationId: $data['DatabaseAdministrationId'] ?? 0,
            id: $data['Id'] ?? 0,
            orderId: $data['OrderId'] ?? null,
            remarks: $data['Remarks'] ?? null,
            freeValue1: $data['FreeValue1'] ?? null,
            freeValue2: $data['FreeValue2'] ?? null,
            freeValue3: $data['FreeValue3'] ?? null,
        );
    }
}
