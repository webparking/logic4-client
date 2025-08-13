<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V12;

use Webparking\Logic4Client\Data\V12\Brand;
use Webparking\Logic4Client\Data\V12\ProductSupplier;
use Webparking\Logic4Client\Data\V12\ProductV11;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V12\ProductExtraBarcodeTypeLogic4ResponseList;

class ProductRequest extends Request
{
    /**
     * @throws Logic4ApiException
     */
    public function getBarcodeTypes(): ProductExtraBarcodeTypeLogic4ResponseList
    {
        return ProductExtraBarcodeTypeLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1.2/Products/GetBarcodeTypes'),
            )
        );
    }

    /**
     * Haal merken op o.b.v. het filter.
     *
     * @param array{
     *     SkipRecords?: int|null,
     *     TakeRecords?: int|null,
     * } $parameters
     *
     * @return \Generator<array-key, Brand>
     *
     * @throws Logic4ApiException
     */
    public function getBrands(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1.2/Products/GetBrands', $parameters);

        foreach ($iterator as $record) {
            yield Brand::make($record);
        }
    }

    /**
     * Verkrijg artikelen o.b.v. het meegestuurde filter. Het aantal op te vragen artikelen is gelimiteerd tot 10000.
     *
     * @param array{
     *     DateTimeChangedFrom?: string|null,
     *     DateTimeChangedTo?: string|null,
     *     LoadFreeValuesTypes?: bool|null,
     *     BrandIds?: array<int>|null,
     *     IsVisibleInLogic4?: bool|null,
     *     IsVisibleOnWebShop?: bool|null,
     *     AllShowOnWebsite?: bool|null,
     *     ProductGroupId?: int|null,
     *     UseChildProductGroups?: bool|null,
     *     ProductCode?: string|null,
     *     Barcode?: string|null,
     *     Barcodes?: array<string>|null,
     *     DebtorId?: int|null,
     *     WebshopUserId?: int|null,
     *     WebshopPriceListId?: int|null,
     *     UseDropShipmentAmountsForWebshopPrices?: bool|null,
     *     ProductIds?: array<int>|null,
     *     ProductFilterListChoice?: string|null,
     *     ProductHistoryBasedOnInvoices?: bool|null,
     *     WebshopUserOrderlistProductType?: int|null,
     *     ActiveOffers?: bool|null,
     *     OfferGroupId?: int|null,
     *     FastSearchText?: string|null,
     *     GetHighestShiftPrice?: bool|null,
     *     CountryIdForSellPrice?: int|null,
     *     BranchIdForSellPrice?: int|null,
     *     LoadExternalStockActiveSupplier?: bool|null,
     *     SkipRecords?: int|null,
     *     TakeRecords?: int|null,
     *     LoadProductGroups?: bool|null,
     *     LoadExtraBarcodes?: bool|null,
     *     OnlyShowParentProducts?: bool|null,
     *     GlobalisationId?: int|null,
     *     WebsiteDomainId?: int|null,
     *     WareHouseId?: int|null,
     *     UseECommerceProductGroups?: bool|null,
     *     UseECommerceProductGroupsToLoadProductGroups?: bool|null,
     *     LoadStockForWarehouses?: bool|null,
     *     LoadAllWebshopGroupsLinkedToProduct?: bool|null,
     *     LoadProductTypes?: bool|null,
     * } $parameters
     *
     * @return \Generator<array-key, ProductV11>
     *
     * @throws Logic4ApiException
     */
    public function getProducts(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1.2/Products/GetProducts', $parameters);

        foreach ($iterator as $record) {
            yield ProductV11::make($record);
        }
    }

    /**
     * Verkrijg alle leveranciers van één of meerdere producten op basis van ProductId's (max. 1000). Of gebruik 'TakeRecords' (max. 10.000).
     * Vanaf v1.2 worden velden met de waarde null niet teruggegeven.
     *
     * @param array{
     *     ProductIds?: array<int>|null,
     *     SkipRecords?: int|null,
     *     TakeRecords?: int|null,
     * } $parameters
     *
     * @return \Generator<array-key, ProductSupplier>
     *
     * @throws Logic4ApiException
     */
    public function getSuppliersForProducts(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1.2/Products/GetSuppliersForProducts', $parameters);

        foreach ($iterator as $record) {
            yield ProductSupplier::make($record);
        }
    }
}
