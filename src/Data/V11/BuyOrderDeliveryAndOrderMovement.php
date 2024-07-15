<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V11;

class BuyOrderDeliveryAndOrderMovement
{
    public function __construct(
        public int $buyOrderDeliveryId,
        public int $orderMovementId,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            buyOrderDeliveryId: $data['BuyOrderDeliveryId'] ?? 0,
            orderMovementId: $data['OrderMovementId'] ?? 0,
        );
    }
}
