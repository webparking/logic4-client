<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V14;

use Webparking\Logic4Client\Data\V14\ProductV14;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;

class ProductRequest extends Request
{
    /**
     * Verkrijg artikelen o.b.v. het meegestuurde filter. Het aantal op te vragen artikelen is gelimiteerd tot 10000.
     *
     * Vanaf v1.4 is de werking van <b>BuyPrice</b> gewijzigd. Dit veld bevat nu de inkoopprijs exclusief toeslagen.
     * In voorgaande versies was dit veld inclusief toeslagen. Deze waarde is nu verplaatst naar het nieuwe veld <b>CostPrice</b>.
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
     * @return \Generator<array-key, ProductV14>
     *
     * @throws Logic4ApiException
     */
    public function getProducts(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1.4/Products/GetProducts', $parameters);

        foreach ($iterator as $record) {
            yield ProductV14::make($record);
        }
    }
}
