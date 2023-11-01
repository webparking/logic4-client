<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

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
            rowId: $data['RowId'],
            amountDelivered: $data['AmountDelivered'],
        );
    }
}
