<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

use Carbon\Carbon;

class CreditorDiscount
{
    public function __construct(
        public int $id,
        public int $typeId,
        public int $creditorId,
        public int $brandId,
        public ?Carbon $dateFrom,
        public ?Carbon $dateTo,
        public ?float $percentage,
        public ?float $amount,
        public ?string $remarks,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            id: $data['Id'] ?? 0,
            typeId: $data['TypeId'] ?? 0,
            creditorId: $data['CreditorId'] ?? 0,
            brandId: $data['BrandId'] ?? 0,
            dateFrom: isset($data['DateFrom']) ? Carbon::parse($data['DateFrom']) : null,
            dateTo: isset($data['DateTo']) ? Carbon::parse($data['DateTo']) : null,
            percentage: $data['Percentage'] ?? null,
            amount: $data['Amount'] ?? null,
            remarks: $data['Remarks'] ?? null,
        );
    }
}
