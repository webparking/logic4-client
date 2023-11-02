<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

use Carbon\Carbon;

class ProductStockControlRow
{
    /** @param array<ProductExtraBarcode> $barcodeExtraList */
    public function __construct(
        public ?int $id,
        public ?int $productStockHeadId,
        public int $productId,
        public ?string $productDescription,
        public ?string $productDescription2,
        public ?string $vendorcode,
        public float $stockTotal,
        public float $stockOnCurrentLocation,
        public ?float $stockCountedByUser,
        public ?Carbon $stockLevelDate,
        public ?string $barcode,
        public ?string $productCode,
        public ?string $barcode2,
        public ?string $systemBarcode,
        public ?array $barcodeExtraList,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            id: $data['Id'] ?? null,
            productStockHeadId: $data['ProductStockHeadId'] ?? null,
            productId: $data['ProductId'] ?? 0,
            productDescription: $data['ProductDescription'] ?? null,
            productDescription2: $data['ProductDescription2'] ?? null,
            vendorcode: $data['Vendorcode'] ?? null,
            stockTotal: $data['StockTotal'] ?? 0.0,
            stockOnCurrentLocation: $data['StockOnCurrentLocation'] ?? 0.0,
            stockCountedByUser: $data['StockCountedByUser'] ?? null,
            stockLevelDate: isset($data['StockLevelDate']) ? Carbon::parse($data['StockLevelDate']) : null,
            barcode: $data['Barcode'] ?? null,
            productCode: $data['ProductCode'] ?? null,
            barcode2: $data['Barcode2'] ?? null,
            systemBarcode: $data['SystemBarcode'] ?? null,
            barcodeExtraList: array_map(static fn (array $item) => ProductExtraBarcode::make($item), $data['BarcodeExtraList'] ?? []),
        );
    }
}
