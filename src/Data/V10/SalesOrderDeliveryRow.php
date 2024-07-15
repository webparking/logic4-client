<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V10;

class SalesOrderDeliveryRow
{
    public function __construct(
        public int $rowId,
        public float $amountDelivered,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            rowId: $data['RowId'] ?? 0,
            amountDelivered: $data['AmountDelivered'] ?? 0.0,
        );
    }
}
