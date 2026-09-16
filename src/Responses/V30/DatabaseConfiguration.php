<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Responses\V30;

class DatabaseConfiguration
{
    public function __construct(
        public int $pickbonExternalStockMovementsIntervalInSeconds,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            pickbonExternalStockMovementsIntervalInSeconds: $data['PickbonExternalStockMovementsIntervalInSeconds'] ?? 0,
        );
    }
}
