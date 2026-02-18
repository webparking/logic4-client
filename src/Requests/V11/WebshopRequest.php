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
     *     Id?: int,
     *     DateTimeAdded?: string,
     *     ComposedProductParentId?: int|null,
     *     WebshopUserId?: int|null,
     *     ProductInformation?: array{SubUnit_ParentId?: int|null, ProductId?: int, ProductCode?: string|null, ProductName1?: string|null, ProductName2?: string|null, ProductInfo?: string|null, StatusId?: int, Statusname?: string|null, BrandId?: int, Brandname?: string|null, Imagename1?: string|null, ImageUrl1?: string|null, Imagename2?: string|null, ImageUrl2?: string|null, Imagename3?: string|null, ImageUrl3?: string|null, Unit?: string|null, UnitId?: int, MinSaleAmount?: int, MinSaleAmountWebshop?: int|null, MinSaleBuyAmountDropShipment?: int|null, SaleCountIncrement?: int|null, SaleCountIncrementWebshop?: int|null, SaleCountIncrementDropShipment?: int|null, MinBuyAmount?: int|null, VatPercent?: number, VatCodeId?: int|null, SellPriceGross?: number, Weight?: number, Volume?: number, Offer?: array{StartDate?: string|null, EndDate?: string|null, FromPrice?: number|null, ToPrice?: number|null, OfferGroupId?: int|null, ProductId?: int}, SellPriceAdvice?: number|null, BuyPrice?: number, ProductGroupId1?: int, ProductGroupId2?: int|null, ProductGroupId3?: int|null, ProductGroupId4?: int|null, BuyCountIncrement?: int|null, SellPriceLowestForWebshop?: number|null, ExcludePriceFromPricelistCalculations?: bool, AdditionalBuyPriceAmount?: number|null, AdditionalBuyPricePercentage?: number|null, IsComposedProduct?: bool|null, IsAssemblyProduct?: bool, ComposedProductSetChildSellPricesToZero?: bool, ComposedProductSetSellPriceToZero?: bool|null, FreeStock?: number, ExternalStockActiveSupplier?: int|null, CreditorDiscountGroupId?: int|null, DateTimeLastChanged?: string, DateTimeAdded?: string, BarCode1?: string|null, FreeValues?: array<array{Key?: string|null, Value?: string|null}>, Sorting?: int|null, NextDelivery?: string|null, Descriptions?: array<array{GlobalisationCode?: string|null, GlobalisationId?: int, Value?: string|null}>, ShiftPrices?: array<array{Qty?: int, BuyPrice?: number, Margin?: number, SellPriceExcl?: number, SellPriceGrossExcl?: number, Description?: string|null, DiscountType?: string|null}>, ProductGroups?: array<array{Id?: int, Name?: string|null, ParentProductGroupId?: int|null, Shortname?: string|null, PictureUrl?: string|null, SortValue?: int, PictureName?: string|null, ProductGroupTypeId?: int, IsVisibleOnWebshop?: bool, DepthLevel?: int, ShowUnitOnWebsite?: bool, Translations?: array<array{Product_GroupId?: int, GlobalisationId?: int, H1Tag?: string|null, Keywords?: string|null, Name?: string|null, ProductGroupInfo?: string|null, Value?: string|null, MetaDescription?: string|null, WebsiteDomainId?: int|null, ShortName?: string|null, GlobalisationCode?: string|null}>}>, Barcode2?: string|null, BarcodeExtraList?: array<array{Barcode?: string|null, Qty?: int}>, SystemBarcode?: string|null, ProductGroup1ProductGroupTypeId?: int, WareHouses?: array<array{WarehouseId?: int, WarehouseName?: string|null, MinimalStock?: number, MaxStock?: number|null, DefaultStockLocationId?: int|null}>, MinimalStock?: int|null, PCSinInsidePackage?: int, PCSinOutsidePackage?: int, ProductType1?: array{Id?: int, Value?: string|null}, ProductType2?: array{Id?: int, Value?: string|null}, ProductType3?: array{Id?: int, Value?: string|null}, ProductType4?: array{Id?: int, Value?: string|null}, ProductType5?: array{Id?: int, Value?: string|null}, StandardAmount?: number|null, VendorCode?: string|null, ProductTemplateId?: int|null, ProductTemplateName?: string|null, HasVariants?: bool, VariantParentProductId?: int|null, Tags?: array<string>, DefaultPickLocation?: int|null, DefaultBulkLocation?: int|null},
     *     ProductId?: int,
     *     QtyDec?: number|null,
     *     Commission?: string|null,
     *     ExcludedFromAnnualBudget?: bool,
     *     TypeId?: int,
     *     DebtorId?: int|null,
     *     VisitorCode?: string|null,
     *     WebsiteDomainId?: int|null,
     *     ShoppingCartKey?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     *
     * @deprecated Let op! Versie 1.1 is verouderd. Gebruik versie v1.3. - WebshopUserProduct toevoegen aan WebshopUserProductlijst
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
     *     SkipRecords?: int,
     *     TakeRecords?: int,
     *     SearchTerm?: string|null,
     *     DateFrom?: string|null,
     *     DateTo?: string|null,
     *     GlobilizationId?: int|null,
     *     DomainId?: int|null,
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
     *     SkipRecords?: int,
     *     TakeRecords?: int,
     *     WebshopUserProductListType?: int|null,
     *     DebtorId?: int|null,
     *     WebshopUserId?: int|null,
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
     *     WebshopUserProductListType?: string,
     *     WebshopPricelistId?: int|null,
     *     GetHighestShiftPrice?: bool|null,
     *     CountryIdForSellPrice?: int|null,
     *     BranchIdForSellPrice?: int|null,
     *     WebsiteDomainId?: int|null,
     *     DebtorWebshopProductTypeId?: int|null,
     *     DebtorId?: int|null,
     *     WebshopUserId?: int|null,
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
