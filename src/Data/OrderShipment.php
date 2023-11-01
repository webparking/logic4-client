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
            id: $data['Id'],
            dateTimeAdded: $data['DateTimeAdded'] ? Carbon::parse($data['DateTimeAdded']) : null,
            orderId: $data['OrderId'],
            shipperId: $data['ShipperId'],
            barcode: $data['Barcode'],
            trackTraceUrl: $data['TrackTraceUrl'],
        );
    }
}
