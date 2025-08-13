<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V12;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V12\BooleanLogic4Response;

class WebshopRequest extends Request
{
    /**
     * Voeg een WebshopUserProduct toe aan een WebshopUserProductlijst.
     *
     * @param array{
     *     Id?: int|null,
     *     DateTimeAdded?: string|null,
     *     ComposedProductParentId?: int|null,
     *     WebshopUserId?: int|null,
     *     ProductInformation?: array{ProductId?: int, ProductCode?: string|null, ProductName1?: string|null, ProductName2?: string|null, ProductInfo?: string|null, StatusId?: int, Statusname?: string|null, BrandId?: int, Brandname?: string|null, Imagename1?: string|null, ImageUrl1?: string|null, Imagename2?: string|null, ImageUrl2?: string|null, Imagename3?: string|null, ImageUrl3?: string|null, Unit?: string|null, UnitId?: int, MinSaleAmount?: int, MinSaleAmountWebshop?: int|null, MinSaleBuyAmountDropShipment?: int|null, SaleCountIncrement?: int|null, SaleCountIncrementWebshop?: int|null, SaleCountIncrementDropShipment?: int|null, MinBuyAmount?: int|null, VatPercent?: number, VatCodeId?: int|null, SellPriceGross?: number, Weight?: number, Volume?: number, Offer?: array{StartDate?: string|null, EndDate?: string|null, FromPrice?: number|null, ToPrice?: number|null, OfferGroupId?: int|null, ProductId?: int}, SellPriceAdvice?: number|null, BuyPrice?: number, ProductGroupId1?: int, BuyCountIncrement?: int|null, SellPriceLowestForWebshop?: number|null, ExcludePriceFromPricelistCalculations?: bool, AdditionalBuyPriceAmount?: number|null, AdditionalBuyPricePercentage?: number|null, IsComposedProduct?: bool|null, IsAssemblyProduct?: bool, ComposedProductSetChildSellPricesToZero?: bool, ComposedProductSetSellPriceToZero?: bool|null, FreeStock?: number, ExternalStockActiveSupplier?: int|null, CreditorDiscountGroupId?: int|null, DateTimeLastChanged?: string, DateTimeAdded?: string, BarCode1?: string|null, FreeValues?: array<array{Key?: string|null, Value?: string|null}>|null, Sorting?: int|null, NextDelivery?: string|null, Descriptions?: array<array{GlobalisationCode?: string|null, GlobalisationId?: int, Value?: string|null}>|null, ShiftPrices?: array<array{Qty?: int, BuyPrice?: number, Margin?: number, SellPriceExcl?: number, SellPriceGrossExcl?: number, Description?: string|null, DiscountType?: string|null}>|null, ProductGroups?: array<array{Id?: int, Name?: string|null, ParentProductGroupId?: int|null, Shortname?: string|null, PictureUrl?: string|null, SortValue?: int, PictureName?: string|null, ProductGroupTypeId?: int, IsVisibleOnWebshop?: bool, DepthLevel?: int, ShowUnitOnWebsite?: bool, Translations?: array<array{Product_GroupId?: int, GlobalisationId?: int, H1Tag?: string|null, Keywords?: string|null, Name?: string|null, ProductGroupInfo?: string|null, Value?: string|null, MetaDescription?: string|null, WebsiteDomainId?: int|null, ShortName?: string|null, GlobalisationCode?: string|null}>|null}>|null, Barcode2?: string|null, BarcodeExtraList?: array<array{Barcode?: string|null, Qty?: int}>|null, SystemBarcode?: string|null, ProductGroup1ProductGroupTypeId?: int, WareHouses?: array<array{WarehouseId?: int, WarehouseName?: string|null, MinimalStock?: number, MaxStock?: number|null, DefaultStockLocationId?: int|null}>|null, MinimalStock?: int|null, PCSinInsidePackage?: int, PCSinOutsidePackage?: int, ProductType1?: array{Id?: int, Value?: string|null}, ProductType2?: array{Id?: int, Value?: string|null}, ProductType3?: array{Id?: int, Value?: string|null}, ProductType4?: array{Id?: int, Value?: string|null}, ProductType5?: array{Id?: int, Value?: string|null}, StandardAmount?: number|null, VendorCode?: string|null, ProductTemplateId?: int|null, ProductTemplateName?: string|null, HasVariants?: bool, VariantParentProductId?: int|null, Tags?: array<string>|null, DefaultPickLocation?: int|null, DefaultBulkLocation?: int|null}|null,
     *     ProductId?: int|null,
     *     QtyDec?: number|null,
     *     Commission?: string|null,
     *     ExcludedFromAnnualBudget?: bool|null,
     *     TypeId?: int|null,
     *     DebtorId?: int|null,
     *     VisitorCode?: string|null,
     *     WebsiteDomainId?: int|null,
     *     ShoppingCartKey?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     *
     * @deprecated Let op! Versie 1.2 is verouderd. Gebruik versie v1.3. - WebshopUserProduct toevoegen aan WebshopUserProductlijst
     */
    public function addWebshopUserProductToWebshopUserProductList(
        array $parameters = [],
    ): BooleanLogic4Response {
        return BooleanLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.2/Webshop/AddWebshopUserProductToWebshopUserProductList', ['json' => $parameters]),
            )
        );
    }
}
