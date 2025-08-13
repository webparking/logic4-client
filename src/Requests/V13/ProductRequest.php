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
        $iterator = $this->paginateRecords('/v1.3/Products/GetProducts', $parameters);

        foreach ($iterator as $record) {
            yield ProductV11::make($record);
        }
    }
}
