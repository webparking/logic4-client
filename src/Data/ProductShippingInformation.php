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
            productId: $data['ProductId'],
            customsTariffnumber: $data['CustomsTariffnumber'],
            productCode: $data['ProductCode'],
            packagesDecimal: $data['PackagesDecimal'],
            piecesOnPallet: $data['PiecesOnPallet'],
            weight: $data['Weight'],
            volume: $data['Volume'],
            width: $data['Width'],
            height: $data['Height'],
            depth: $data['Depth'],
        );
    }
}
