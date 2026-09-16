<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V13;

use Webparking\Logic4Client\Data\V13\ProductV11;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;

class ProductRequest extends Request
{
    /**
     * Verkrijg artikelen o.b.v. het meegestuurde filter. Het aantal op te vragen artikelen is gelimiteerd tot 10000.
     * Vanaf v1.3 worden velden met de waarde null niet teruggegeven.
     *
     * @param array{
     *     DateTimeChangedFrom?: string|null,
     *     DateTimeChangedTo?: string|null,
     *     LoadFreeValuesTypes?: bool,
     *     BrandIds?: array<int>,
     *     IsVisibleInLogic4?: bool|null,
     *     IsVisibleOnWebShop?: bool|null,
     *     AllShowOnWebsite?: bool|null,
     *     ProductGroupId?: int|null,
     *     UseChildProductGroups?: bool|null,
     *     ProductCode?: string|null,
     *     Barcode?: string|null,
     *     Barcodes?: array<string>,
     *     DebtorId?: int|null,
     *     WebshopUserId?: int|null,
     *     WebshopPriceListId?: int|null,
     *     UseDropShipmentAmountsForWebshopPrices?: bool|null,
     *     ProductIds?: array<int>,
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
     *     LoadExtraBarcodes?: bool,
     *     OnlyShowParentProducts?: bool|null,
     *     GlobalisationId?: int|null,
     *     WebsiteDomainId?: int|null,
     *     WareHouseId?: int|null,
     *     UseECommerceProductGroups?: bool,
     *     UseECommerceProductGroupsToLoadProductGroups?: bool,
     *     LoadStockForWarehouses?: bool,
     *     LoadAllWebshopGroupsLinkedToProduct?: bool,
     *     LoadProductTypes?: bool,
     * } $parameters
     *
     * @return \Generator<array-key, ProductV11>
     *
     * @throws Logic4ApiException
     */
    public function getProducts(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1.3/Products/GetProducts', $parameters);

        foreach ($iterator as $record) {
            yield ProductV11::make($record);
        }
    }
}
