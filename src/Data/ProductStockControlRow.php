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
            id: $data['Id'],
            productStockHeadId: $data['ProductStockHeadId'],
            productId: $data['ProductId'],
            productDescription: $data['ProductDescription'],
            productDescription2: $data['ProductDescription2'],
            vendorcode: $data['Vendorcode'],
            stockTotal: $data['StockTotal'],
            stockOnCurrentLocation: $data['StockOnCurrentLocation'],
            stockCountedByUser: $data['StockCountedByUser'],
            stockLevelDate: $data['StockLevelDate'] ? Carbon::parse($data['StockLevelDate']) : null,
            barcode: $data['Barcode'],
            productCode: $data['ProductCode'],
            barcode2: $data['Barcode2'],
            systemBarcode: $data['SystemBarcode'],
            barcodeExtraList: array_map(static fn (array $item) => ProductExtraBarcode::make($item), $data['BarcodeExtraList'] ?? []),
        );
    }
}
