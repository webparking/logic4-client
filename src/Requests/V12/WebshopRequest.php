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
     *     Id?: integer|null,
     *     DateTimeAdded?: string|null,
     *     ProductId?: integer|null,
     *     QtyDec?: number|null,
     *     Commission?: string|null,
     *     ExcludedFromAnnualBudget?: boolean|null,
     *     ComposedProductParentId?: integer|null,
     *     TypeId?: integer|null,
     *     WebshopUserId?: integer|null,
     *     DebtorId?: integer|null,
     *     ProductInformation?: array{ProductId?: integer, ProductCode?: string, ProductName1?: string, ProductName2?: string, ProductInfo?: string, StatusId?: integer, Statusname?: string, BrandId?: integer, Brandname?: string, Imagename1?: string, ImageUrl1?: string, Imagename2?: string, ImageUrl2?: string, Imagename3?: string, ImageUrl3?: string, Unit?: string, UnitId?: integer, MinSaleAmount?: integer, MinSaleAmountWebshop?: integer, MinSaleBuyAmountDropShipment?: integer, SaleCountIncrement?: integer, SaleCountIncrementWebshop?: integer, SaleCountIncrementDropShipment?: integer, MinBuyAmount?: integer, VatPercent?: number, VatCodeId?: integer, SellPriceGross?: number, Weight?: number, Volume?: number, Offer?: array{StartDate?: string, EndDate?: string, FromPrice?: number, ToPrice?: number, OfferGroupId?: integer, ProductId?: integer}, SellPriceAdvice?: number, BuyPrice?: number, ProductGroupId1?: integer, BuyCountIncrement?: integer, SellPriceLowestForWebshop?: number, ExcludePriceFromPricelistCalculations?: boolean, AdditionalBuyPriceAmount?: number, AdditionalBuyPricePercentage?: number, IsComposedProduct?: boolean, IsAssemblyProduct?: boolean, ComposedProductSetChildSellPricesToZero?: boolean, ComposedProductSetSellPriceToZero?: boolean, FreeStock?: number, ExternalStockActiveSupplier?: integer, CreditorDiscountGroupId?: integer, DateTimeLastChanged?: string, DateTimeAdded?: string, BarCode1?: string, FreeValues?: array<array{Key?: string, Value?: string}>, Sorting?: integer, NextDelivery?: string, Descriptions?: array<array{GlobalisationCode?: string, GlobalisationId?: integer, Value?: string}>, ShiftPrices?: array<array{Qty?: integer, BuyPrice?: number, Margin?: number, SellPriceExcl?: number, SellPriceGrossExcl?: number, Description?: string, DiscountType?: string}>, ProductGroups?: array<array{Id?: integer, Name?: string, ParentProductGroupId?: integer, Shortname?: string, PictureUrl?: string, SortValue?: integer, PictureName?: string, ProductGroupTypeId?: integer, IsVisibleOnWebshop?: boolean, DepthLevel?: integer, ShowUnitOnWebsite?: boolean, Translations?: array<array{Product_GroupId?: integer, GlobalisationId?: integer, H1Tag?: string, Keywords?: string, Name?: string, ProductGroupInfo?: string, Value?: string, MetaDescription?: string, WebsiteDomainId?: integer, ShortName?: string, GlobalisationCode?: string}>}>, Barcode2?: string, BarcodeExtraList?: array<array{Barcode?: string, Qty?: integer}>, SystemBarcode?: string, ProductGroup1ProductGroupTypeId?: integer, WareHouses?: array<array{WarehouseId?: integer, WarehouseName?: string, MinimalStock?: number, MaxStock?: number, DefaultStockLocationId?: integer}>, MinimalStock?: integer, PCSinInsidePackage?: integer, PCSinOutsidePackage?: integer, ProductType1?: array{Id?: integer, Value?: string}, ProductType2?: array{Id?: integer, Value?: string}, ProductType3?: array{Id?: integer, Value?: string}, ProductType4?: array{Id?: integer, Value?: string}, ProductType5?: array{Id?: integer, Value?: string}, StandardAmount?: number, VendorCode?: string, ProductTemplateId?: integer, ProductTemplateName?: string, HasVariants?: boolean, VariantParentProductId?: integer, Tags?: array<string>}|null,
     *     VisitorCode?: string|null,
     *     WebsiteDomainId?: integer|null,
     *     ShoppingCartKey?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
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
