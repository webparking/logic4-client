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
            id: $data['Id'],
            typeId: $data['TypeId'],
            creditorId: $data['CreditorId'],
            brandId: $data['BrandId'],
            dateFrom: $data['DateFrom'] ? Carbon::parse($data['DateFrom']) : null,
            dateTo: $data['DateTo'] ? Carbon::parse($data['DateTo']) : null,
            percentage: $data['Percentage'],
            amount: $data['Amount'],
            remarks: $data['Remarks'],
        );
    }
}
