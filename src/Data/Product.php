<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

use Carbon\Carbon;

class Product
{
    /**
     * @param array<FreeValue>             $freeValues
     * @param array<Translation>           $descriptions
     * @param array<ProductShiftPrice>     $shiftPrices
     * @param array<ProductGroup>          $productGroups
     * @param array<ProductExtraBarcode>   $barcodeExtraList
     * @param array<ProductStockWarehouse> $wareHouses
     */
    public function __construct(
        public int $productId,
        public ?int $subUnitParentId,
        public ?string $productCode,
        public ?string $productName1,
        public ?string $productName2,
        public ?string $productInfo,
        public int $statusId,
        public ?string $statusname,
        public int $brandId,
        public ?string $brandname,
        public ?string $imagename1,
        public ?string $imageUrl1,
        public ?string $imagename2,
        public ?string $imageUrl2,
        public ?string $imagename3,
        public ?string $imageUrl3,
        public ?string $unit,
        public int $unitId,
        public int $minSaleAmount,
        public ?int $minSaleAmountWebshop,
        public ?int $minSaleBuyAmountDropShipment,
        public ?int $saleCountIncrement,
        public ?int $saleCountIncrementWebshop,
        public ?int $saleCountIncrementDropShipment,
        public ?int $minBuyAmount,
        public float $vatPercent,
        public ?int $vatCodeId,
        public float $sellPriceGross,
        public float $weight,
        public float $volume,
        public ?ProductOffer $offer,
        public ?float $sellPriceAdvice,
        public float $buyPrice,
        public int $productGroupId1,
        public ?int $buyCountIncrement,
        public ?float $sellPriceLowestForWebshop,
        public bool $excludePriceFromPricelistCalculations,
        public ?float $additionalBuyPriceAmount,
        public ?float $additionalBuyPricePercentage,
        public ?bool $isComposedProduct,
        public bool $isAssemblyProduct,
        public bool $composedProductSetChildSellPricesToZero,
        public ?bool $composedProductSetSellPriceToZero,
        public float $freeStock,
        public ?int $externalStockActiveSupplier,
        public ?int $creditorDiscountGroupId,
        public ?Carbon $dateTimeLastChanged,
        public ?Carbon $dateTimeAdded,
        public ?string $barCode1,
        public ?array $freeValues,
        public ?int $sorting,
        public ?Carbon $nextDelivery,
        public ?array $descriptions,
        public ?array $shiftPrices,
        public ?array $productGroups,
        public ?string $barcode2,
        public ?array $barcodeExtraList,
        public ?string $systemBarcode,
        public int $productGroup1ProductGroupTypeId,
        public ?array $wareHouses,
        public ?int $minimalStock,
        public int $PCSinInsidePackage,
        public int $PCSinOutsidePackage,
        public ?ProductType $productType1,
        public ?ProductType $productType2,
        public ?ProductType $productType3,
        public ?ProductType $productType4,
        public ?ProductType $productType5,
        public ?float $standardAmount,
        public ?string $vendorCode,
        public ?int $productTemplateId,
        public ?string $productTemplateName,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            productId: $data['ProductId'],
            subUnitParentId: $data['SubUnit_ParentId'],
            productCode: $data['ProductCode'],
            productName1: $data['ProductName1'],
            productName2: $data['ProductName2'],
            productInfo: $data['ProductInfo'],
            statusId: $data['StatusId'],
            statusname: $data['Statusname'],
            brandId: $data['BrandId'],
            brandname: $data['Brandname'],
            imagename1: $data['Imagename1'],
            imageUrl1: $data['ImageUrl1'],
            imagename2: $data['Imagename2'],
            imageUrl2: $data['ImageUrl2'],
            imagename3: $data['Imagename3'],
            imageUrl3: $data['ImageUrl3'],
            unit: $data['Unit'],
            unitId: $data['UnitId'],
            minSaleAmount: $data['MinSaleAmount'],
            minSaleAmountWebshop: $data['MinSaleAmountWebshop'],
            minSaleBuyAmountDropShipment: $data['MinSaleBuyAmountDropShipment'],
            saleCountIncrement: $data['SaleCountIncrement'],
            saleCountIncrementWebshop: $data['SaleCountIncrementWebshop'],
            saleCountIncrementDropShipment: $data['SaleCountIncrementDropShipment'],
            minBuyAmount: $data['MinBuyAmount'],
            vatPercent: $data['VatPercent'],
            vatCodeId: $data['VatCodeId'],
            sellPriceGross: $data['SellPriceGross'],
            weight: $data['Weight'],
            volume: $data['Volume'],
            offer: $data['Offer'] ? ProductOffer::make($data['Offer']) : null,
            sellPriceAdvice: $data['SellPriceAdvice'],
            buyPrice: $data['BuyPrice'],
            productGroupId1: $data['ProductGroupId1'],
            buyCountIncrement: $data['BuyCountIncrement'],
            sellPriceLowestForWebshop: $data['SellPriceLowestForWebshop'],
            excludePriceFromPricelistCalculations: $data['ExcludePriceFromPricelistCalculations'],
            additionalBuyPriceAmount: $data['AdditionalBuyPriceAmount'],
            additionalBuyPricePercentage: $data['AdditionalBuyPricePercentage'],
            isComposedProduct: $data['IsComposedProduct'],
            isAssemblyProduct: $data['IsAssemblyProduct'],
            composedProductSetChildSellPricesToZero: $data['ComposedProductSetChildSellPricesToZero'],
            composedProductSetSellPriceToZero: $data['ComposedProductSetSellPriceToZero'],
            freeStock: $data['FreeStock'],
            externalStockActiveSupplier: $data['ExternalStockActiveSupplier'],
            creditorDiscountGroupId: $data['CreditorDiscountGroupId'],
            dateTimeLastChanged: $data['DateTimeLastChanged'] ? Carbon::parse($data['DateTimeLastChanged']) : null,
            dateTimeAdded: $data['DateTimeAdded'] ? Carbon::parse($data['DateTimeAdded']) : null,
            barCode1: $data['BarCode1'],
            freeValues: array_map(static fn (array $item) => FreeValue::make($item), $data['FreeValues'] ?? []),
            sorting: $data['Sorting'],
            nextDelivery: $data['NextDelivery'] ? Carbon::parse($data['NextDelivery']) : null,
            descriptions: array_map(static fn (array $item) => Translation::make($item), $data['Descriptions'] ?? []),
            shiftPrices: array_map(static fn (array $item) => ProductShiftPrice::make($item), $data['ShiftPrices'] ?? []),
            productGroups: array_map(static fn (array $item) => ProductGroup::make($item), $data['ProductGroups'] ?? []),
            barcode2: $data['Barcode2'],
            barcodeExtraList: array_map(static fn (array $item) => ProductExtraBarcode::make($item), $data['BarcodeExtraList'] ?? []),
            systemBarcode: $data['SystemBarcode'],
            productGroup1ProductGroupTypeId: $data['ProductGroup1ProductGroupTypeId'],
            wareHouses: array_map(static fn (array $item) => ProductStockWarehouse::make($item), $data['WareHouses'] ?? []),
            minimalStock: $data['MinimalStock'],
            PCSinInsidePackage: $data['PCSinInsidePackage'],
            PCSinOutsidePackage: $data['PCSinOutsidePackage'],
            productType1: $data['ProductType1'] ? ProductType::make($data['ProductType1']) : null,
            productType2: $data['ProductType2'] ? ProductType::make($data['ProductType2']) : null,
            productType3: $data['ProductType3'] ? ProductType::make($data['ProductType3']) : null,
            productType4: $data['ProductType4'] ? ProductType::make($data['ProductType4']) : null,
            productType5: $data['ProductType5'] ? ProductType::make($data['ProductType5']) : null,
            standardAmount: $data['StandardAmount'],
            vendorCode: $data['VendorCode'],
            productTemplateId: $data['ProductTemplateId'],
            productTemplateName: $data['ProductTemplateName'],
        );
    }
}