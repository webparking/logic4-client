<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Responses\V30;

class Country
{
    /** @param array<\Webparking\Logic4Client\Data\V30\Translation> $names */
    public function __construct(
        public int $id,
        public int $zoneId,
        public ?array $names,
        public ?string $isoCode,
        public ?string $countryCode,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            id: $data['Id'] ?? 0,
            zoneId: $data['ZoneId'] ?? 0,
            names: array_map(static fn (array $item) => \Webparking\Logic4Client\Data\V30\Translation::make($item), $data['Names'] ?? []),
            isoCode: $data['IsoCode'] ?? null,
            countryCode: $data['CountryCode'] ?? null,
        );
    }
}
