<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V11;

use Webparking\Logic4Client\Data\V11\WebshopOrderlistProduct;
use Webparking\Logic4Client\Data\V11\WebshopSearchWord;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V11\BooleanLogic4Response;
use Webparking\Logic4Client\Responses\V11\ProductV12WebshopUserProductLogic4ResponseList;

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
     *     ProductInformation?: array{SubUnit_ParentId?: integer, ProductId?: integer, ProductCode?: string, ProductName1?: string, ProductName2?: string, ProductInfo?: string, StatusId?: integer, Statusname?: string, BrandId?: integer, Brandname?: string, Imagename1?: string, ImageUrl1?: string, Imagename2?: string, ImageUrl2?: string, Imagename3?: string, ImageUrl3?: string, Unit?: string, UnitId?: integer, MinSaleAmount?: integer, MinSaleAmountWebshop?: integer, MinSaleBuyAmountDropShipment?: integer, SaleCountIncrement?: integer, SaleCountIncrementWebshop?: integer, SaleCountIncrementDropShipment?: integer, MinBuyAmount?: integer, VatPercent?: number, VatCodeId?: integer, SellPriceGross?: number, Weight?: number, Volume?: number, Offer?: array{StartDate?: string, EndDate?: string, FromPrice?: number, ToPrice?: number, OfferGroupId?: integer, ProductId?: integer}, SellPriceAdvice?: number, BuyPrice?: number, ProductGroupId1?: integer, BuyCountIncrement?: integer, SellPriceLowestForWebshop?: number, ExcludePriceFromPricelistCalculations?: boolean, AdditionalBuyPriceAmount?: number, AdditionalBuyPricePercentage?: number, IsComposedProduct?: boolean, IsAssemblyProduct?: boolean, ComposedProductSetChildSellPricesToZero?: boolean, ComposedProductSetSellPriceToZero?: boolean, FreeStock?: number, ExternalStockActiveSupplier?: integer, CreditorDiscountGroupId?: integer, DateTimeLastChanged?: string, DateTimeAdded?: string, BarCode1?: string, FreeValues?: array<array{Key?: string, Value?: string}>, Sorting?: integer, NextDelivery?: string, Descriptions?: array<array{GlobalisationCode?: string, GlobalisationId?: integer, Value?: string}>, ShiftPrices?: array<array{Qty?: integer, BuyPrice?: number, Margin?: number, SellPriceExcl?: number, SellPriceGrossExcl?: number, Description?: string, DiscountType?: string}>, ProductGroups?: array<array{Id?: integer, Name?: string, ParentProductGroupId?: integer, Shortname?: string, PictureUrl?: string, SortValue?: integer, PictureName?: string, ProductGroupTypeId?: integer, IsVisibleOnWebshop?: boolean, DepthLevel?: integer, ShowUnitOnWebsite?: boolean, Translations?: array<array{Product_GroupId?: integer, GlobalisationId?: integer, H1Tag?: string, Keywords?: string, Name?: string, ProductGroupInfo?: string, Value?: string, MetaDescription?: string, WebsiteDomainId?: integer, ShortName?: string, GlobalisationCode?: string}>}>, Barcode2?: string, BarcodeExtraList?: array<array{Barcode?: string, Qty?: integer}>, SystemBarcode?: string, ProductGroup1ProductGroupTypeId?: integer, WareHouses?: array<array{WarehouseId?: integer, WarehouseName?: string, MinimalStock?: number, MaxStock?: number, DefaultStockLocationId?: integer}>, MinimalStock?: integer, PCSinInsidePackage?: integer, PCSinOutsidePackage?: integer, ProductType1?: array{Id?: integer, Value?: string}, ProductType2?: array{Id?: integer, Value?: string}, ProductType3?: array{Id?: integer, Value?: string}, ProductType4?: array{Id?: integer, Value?: string}, ProductType5?: array{Id?: integer, Value?: string}, StandardAmount?: number, VendorCode?: string, ProductTemplateId?: integer, ProductTemplateName?: string, HasVariants?: boolean, VariantParentProductId?: integer}|null,
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
                $this->getClient()->post('/v1.1/Webshop/AddWebshopUserProductToWebshopUserProductList', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg zoekresultaten van een webshop o.b.v. meegestuurde filter.
     *
     * @param array{
     *     SkipRecords?: integer|null,
     *     TakeRecords?: integer|null,
     *     SearchTerm?: string|null,
     *     DateFrom?: string|null,
     *     DateTo?: string|null,
     *     GlobilizationId?: integer|null,
     *     DomainId?: integer|null,
     * } $parameters
     *
     * @return \Generator<array-key, WebshopSearchWord>
     *
     * @throws Logic4ApiException
     */
    public function getWebshopSearchWords(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1.1/Webshop/GetWebshopSearchWords', $parameters);

        foreach ($iterator as $record) {
            yield WebshopSearchWord::make($record);
        }
    }

    /**
     * Verkrijg een bestellijst o.b.v. webshopgebruikersnummer of debiteurnummer voor de producttypes zie eindpunt /Webshop/GetWebshopUserOrderlistProductTypes.
     *
     * @param array{
     *     SkipRecords?: integer|null,
     *     TakeRecords?: integer|null,
     *     WebshopUserProductListType?: integer|null,
     *     DebtorId?: integer|null,
     *     WebshopUserId?: integer|null,
     * } $parameters
     *
     * @return \Generator<array-key, WebshopOrderlistProduct>
     *
     * @throws Logic4ApiException
     */
    public function getWebshopUserOrderlist(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1.1/Webshop/GetWebshopUserOrderlist', $parameters);

        foreach ($iterator as $record) {
            yield WebshopOrderlistProduct::make($record);
        }
    }

    /**
     * Verkrijg een WebshopUserProductlijst (Zie eindpunt /Webshop/GetWebshopUserProductListTypes voor de types) o.b.v. webshopgebruikersnummer of debiteurnummer.
     *
     * @param array{
     *     VisitorCode?: string|null,
     *     WebshopUserProductListType?: string|null,
     *     WebshopPricelistId?: integer|null,
     *     GetHighestShiftPrice?: boolean|null,
     *     CountryIdForSellPrice?: integer|null,
     *     BranchIdForSellPrice?: integer|null,
     *     WebsiteDomainId?: integer|null,
     *     DebtorWebshopProductTypeId?: integer|null,
     *     DebtorId?: integer|null,
     *     WebshopUserId?: integer|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getWebshopUserProductList(
        array $parameters = [],
    ): ProductV12WebshopUserProductLogic4ResponseList {
        return ProductV12WebshopUserProductLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.1/Webshop/GetWebshopUserProductList', ['json' => $parameters]),
            )
        );
    }
}
