<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V10;

class Country
{
    /** @param array<Translation> $names */
    public function __construct(
        public int $id,
        public int $zoneId,
        public ?array $names,
        public ?string $isoCode,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            id: $data['Id'] ?? 0,
            zoneId: $data['ZoneId'] ?? 0,
            names: array_map(static fn (array $item) => Translation::make($item), $data['Names'] ?? []),
            isoCode: $data['IsoCode'] ?? null,
        );
    }
}
