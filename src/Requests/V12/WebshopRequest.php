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
     *     ProductInformation?: array{ProductId?: integer, ProductCode?: string|null, ProductName1?: string|null, ProductName2?: string|null, ProductInfo?: string|null, StatusId?: integer, Statusname?: string|null, BrandId?: integer, Brandname?: string|null, Imagename1?: string|null, ImageUrl1?: string|null, Imagename2?: string|null, ImageUrl2?: string|null, Imagename3?: string|null, ImageUrl3?: string|null, Unit?: string|null, UnitId?: integer, MinSaleAmount?: integer, MinSaleAmountWebshop?: integer|null, MinSaleBuyAmountDropShipment?: integer|null, SaleCountIncrement?: integer|null, SaleCountIncrementWebshop?: integer|null, SaleCountIncrementDropShipment?: integer|null, MinBuyAmount?: integer|null, VatPercent?: number, VatCodeId?: integer|null, SellPriceGross?: number, Weight?: number, Volume?: number, Offer?: array{StartDate?: string|null, EndDate?: string|null, FromPrice?: number|null, ToPrice?: number|null, OfferGroupId?: integer|null, ProductId?: integer}, SellPriceAdvice?: number|null, BuyPrice?: number, ProductGroupId1?: integer, BuyCountIncrement?: integer|null, SellPriceLowestForWebshop?: number|null, ExcludePriceFromPricelistCalculations?: boolean, AdditionalBuyPriceAmount?: number|null, AdditionalBuyPricePercentage?: number|null, IsComposedProduct?: boolean|null, IsAssemblyProduct?: boolean, ComposedProductSetChildSellPricesToZero?: boolean, ComposedProductSetSellPriceToZero?: boolean|null, FreeStock?: number, ExternalStockActiveSupplier?: integer|null, CreditorDiscountGroupId?: integer|null, DateTimeLastChanged?: string, DateTimeAdded?: string, BarCode1?: string|null, FreeValues?: array<array{Key?: string|null, Value?: string|null}>|null, Sorting?: integer|null, NextDelivery?: string|null, Descriptions?: array<array{GlobalisationCode?: string|null, GlobalisationId?: integer, Value?: string|null}>|null, ShiftPrices?: array<array{Qty?: integer, BuyPrice?: number, Margin?: number, SellPriceExcl?: number, SellPriceGrossExcl?: number, Description?: string|null, DiscountType?: string|null}>|null, ProductGroups?: array<array{Id?: integer, Name?: string|null, ParentProductGroupId?: integer|null, Shortname?: string|null, PictureUrl?: string|null, SortValue?: integer, PictureName?: string|null, ProductGroupTypeId?: integer, IsVisibleOnWebshop?: boolean, DepthLevel?: integer, ShowUnitOnWebsite?: boolean, Translations?: array<array{Product_GroupId?: integer, GlobalisationId?: integer, H1Tag?: string|null, Keywords?: string|null, Name?: string|null, ProductGroupInfo?: string|null, Value?: string|null, MetaDescription?: string|null, WebsiteDomainId?: integer|null, ShortName?: string|null, GlobalisationCode?: string|null}>|null}>|null, Barcode2?: string|null, BarcodeExtraList?: array<array{Barcode?: string|null, Qty?: integer}>|null, SystemBarcode?: string|null, ProductGroup1ProductGroupTypeId?: integer, WareHouses?: array<array{WarehouseId?: integer, WarehouseName?: string|null, MinimalStock?: number, MaxStock?: number|null, DefaultStockLocationId?: integer|null}>|null, MinimalStock?: integer|null, PCSinInsidePackage?: integer, PCSinOutsidePackage?: integer, ProductType1?: array{Id?: integer, Value?: string|null}, ProductType2?: array{Id?: integer, Value?: string|null}, ProductType3?: array{Id?: integer, Value?: string|null}, ProductType4?: array{Id?: integer, Value?: string|null}, ProductType5?: array{Id?: integer, Value?: string|null}, StandardAmount?: number|null, VendorCode?: string|null, ProductTemplateId?: integer|null, ProductTemplateName?: string|null, HasVariants?: boolean, VariantParentProductId?: integer|null, Tags?: array<string>|null}|null,
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
