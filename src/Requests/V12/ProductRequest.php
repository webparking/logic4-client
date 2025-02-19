<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V12;

use Webparking\Logic4Client\Data\V12\Brand;
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
     *     SkipRecords?: integer|null,
     *     TakeRecords?: integer|null,
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
     *     LoadFreeValuesTypes?: boolean|null,
     *     BrandIds?: array<integer>|null,
     *     IsVisibleInLogic4?: boolean|null,
     *     IsVisibleOnWebShop?: boolean|null,
     *     AllShowOnWebsite?: boolean|null,
     *     ProductGroupId?: integer|null,
     *     UseChildProductGroups?: boolean|null,
     *     ProductCode?: string|null,
     *     Barcode?: string|null,
     *     Barcodes?: array<string>|null,
     *     DebtorId?: integer|null,
     *     WebshopUserId?: integer|null,
     *     WebshopPriceListId?: integer|null,
     *     UseDropShipmentAmountsForWebshopPrices?: boolean|null,
     *     ProductIds?: array<integer>|null,
     *     ProductFilterListChoice?: string|null,
     *     ProductHistoryBasedOnInvoices?: boolean|null,
     *     WebshopUserOrderlistProductType?: integer|null,
     *     ActiveOffers?: boolean|null,
     *     OfferGroupId?: integer|null,
     *     FastSearchText?: string|null,
     *     GetHighestShiftPrice?: boolean|null,
     *     CountryIdForSellPrice?: integer|null,
     *     BranchIdForSellPrice?: integer|null,
     *     LoadExternalStockActiveSupplier?: boolean|null,
     *     SkipRecords?: integer|null,
     *     TakeRecords?: integer|null,
     *     LoadProductGroups?: boolean|null,
     *     LoadExtraBarcodes?: boolean|null,
     *     OnlyShowParentProducts?: boolean|null,
     *     GlobalisationId?: integer|null,
     *     WebsiteDomainId?: integer|null,
     *     WareHouseId?: integer|null,
     *     UseECommerceProductGroups?: boolean|null,
     *     UseECommerceProductGroupsToLoadProductGroups?: boolean|null,
     *     LoadStockForWarehouses?: boolean|null,
     *     LoadAllWebshopGroupsLinkedToProduct?: boolean|null,
     *     LoadProductTypes?: boolean|null,
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
}
