<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

use Carbon\Carbon;

class OrderShipment
{
    public function __construct(
        public int $id,
        public ?Carbon $dateTimeAdded,
        public int $orderId,
        public int $shipperId,
        public ?string $barcode,
        public ?string $trackTraceUrl,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            id: $data['Id'] ?? 0,
            dateTimeAdded: isset($data['DateTimeAdded']) ? Carbon::parse($data['DateTimeAdded']) : null,
            orderId: $data['OrderId'] ?? 0,
            shipperId: $data['ShipperId'] ?? 0,
            barcode: $data['Barcode'] ?? null,
            trackTraceUrl: $data['TrackTraceUrl'] ?? null,
        );
    }
}
