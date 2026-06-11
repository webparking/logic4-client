<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V13;

class OrderShipment
{
    public function __construct(
        public int $id,
        public ?int $deliveryId,
        public ?\Carbon\Carbon $dateTimeAdded,
        public ?bool $sendEmail,
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
            deliveryId: $data['DeliveryId'] ?? null,
            dateTimeAdded: isset($data['DateTimeAdded']) ? \Carbon\Carbon::parse($data['DateTimeAdded']) : null,
            sendEmail: $data['SendEmail'] ?? null,
            orderId: $data['OrderId'] ?? 0,
            shipperId: $data['ShipperId'] ?? 0,
            barcode: $data['Barcode'] ?? null,
            trackTraceUrl: $data['TrackTraceUrl'] ?? null,
        );
    }
}
