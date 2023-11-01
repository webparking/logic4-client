<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

use Carbon\Carbon;

class BuyOrderBaseInfo
{
    public function __construct(
        public int $amountOfRows,
        public ?int $branchId,
        public bool $buyOrderClosed,
        public ?Carbon $createdAt,
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
            amountOfRows: $data['AmountOfRows'],
            branchId: $data['BranchId'],
            buyOrderClosed: $data['BuyOrderClosed'],
            createdAt: $data['CreatedAt'] ? Carbon::parse($data['CreatedAt']) : null,
            creditorCompanyName: $data['CreditorCompanyName'],
            creditorId: $data['CreditorId'],
            databaseAdministrationId: $data['DatabaseAdministrationId'],
            id: $data['Id'],
            orderId: $data['OrderId'],
            remarks: $data['Remarks'],
            freeValue1: $data['FreeValue1'],
            freeValue2: $data['FreeValue2'],
            freeValue3: $data['FreeValue3'],
        );
    }
}
