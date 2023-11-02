<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

class ProductShippingInformation
{
    public function __construct(
        public int $productId,
        public ?string $customsTariffnumber,
        public ?string $productCode,
        public ?float $packagesDecimal,
        public ?int $piecesOnPallet,
        public float $weight,
        public float $volume,
        public float $width,
        public float $height,
        public float $depth,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            productId: $data['ProductId'] ?? 0,
            customsTariffnumber: $data['CustomsTariffnumber'] ?? null,
            productCode: $data['ProductCode'] ?? null,
            packagesDecimal: $data['PackagesDecimal'] ?? null,
            piecesOnPallet: $data['PiecesOnPallet'] ?? null,
            weight: $data['Weight'] ?? 0.0,
            volume: $data['Volume'] ?? 0.0,
            width: $data['Width'] ?? 0.0,
            height: $data['Height'] ?? 0.0,
            depth: $data['Depth'] ?? 0.0,
        );
    }
}
