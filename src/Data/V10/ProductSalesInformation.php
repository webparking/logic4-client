<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V10;

class ProductSalesInformation
{
    public function __construct(
        public ?string $productCode,
        public ?string $productDescription,
        public float $value,
        public ?\Carbon\Carbon $dateStart,
        public ?\Carbon\Carbon $dateEnd,
        public ?string $periodDescription,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            productCode: $data['ProductCode'] ?? null,
            productDescription: $data['ProductDescription'] ?? null,
            value: $data['Value'] ?? 0.0,
            dateStart: isset($data['DateStart']) ? \Carbon\Carbon::parse($data['DateStart']) : null,
            dateEnd: isset($data['DateEnd']) ? \Carbon\Carbon::parse($data['DateEnd']) : null,
            periodDescription: $data['PeriodDescription'] ?? null,
        );
    }
}
