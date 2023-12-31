<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

use Carbon\Carbon;

class ValuevsBudget
{
    public function __construct(
        public ?float $budget,
        public ?int $typeContactGroupId,
        public float $value,
        public ?Carbon $dateStart,
        public ?Carbon $dateEnd,
        public ?string $periodDescription,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            budget: $data['Budget'] ?? null,
            typeContactGroupId: $data['TypeContactGroupId'] ?? null,
            value: $data['Value'] ?? 0.0,
            dateStart: isset($data['DateStart']) ? Carbon::parse($data['DateStart']) : null,
            dateEnd: isset($data['DateEnd']) ? Carbon::parse($data['DateEnd']) : null,
            periodDescription: $data['PeriodDescription'] ?? null,
        );
    }
}
