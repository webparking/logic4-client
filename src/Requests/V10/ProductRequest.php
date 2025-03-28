<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V10;

use Webparking\Logic4Client\Data\V10\ProductSupplier;
use Webparking\Logic4Client\Data\V10\ProductV11;
use Webparking\Logic4Client\Data\V10\ProductVariantBalkChildrenGroup;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V10\BasicProductDataLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\BooleanLogic4Response;
use Webparking\Logic4Client\Responses\V10\BrandLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\Int32Logic4Response;
use Webparking\Logic4Client\Responses\V10\Int32Logic4ResponseList;
use Webparking\Logic4Client\Responses\V10\Logic4Response;
use Webparking\Logic4Client\Responses\V10\PackingMaterialDepositTypeLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\ProductAssemblyRecipeItemLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\ProductBarcodeLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\ProductCodeWithSupplierCodeLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\ProductCompositionItemLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\ProductDimensionsLogic4Response;
use Webparking\Logic4Client\Responses\V10\ProductPickLocationBasedOnSystemSettingsLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\ProductPriceInformationLogic4Response;
use Webparking\Logic4Client\Responses\V10\ProductPricelistLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\ProductReviewLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\ProductShippingInformationLogic4Response;
use Webparking\Logic4Client\Responses\V10\ProductStatusLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\ProductSupplierLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\ProductUnitLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\ProductVariantBalkLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\VariantBalkCategoryLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\WebsiteDomainsForProductLogic4ResponseList;

class ProductRequest extends Request
{
    /**
     * Koppelen van een website aan een product, max 1000 producten per call.
     * Als een webshopdomein al reeds gekoppeld is, dan wordt deze overgeslagen.
     *
     * @param array{
     *     ProductIds?: array<integer>|null,
     *     WebsiteDomainId?: integer|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addWebsiteDomainForProducts(
        array $parameters = [],
    ): BooleanLogic4Response {
        return BooleanLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Products/AddWebsiteDomainForProducts', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verwijder een website dat gekoppeld zit aan een product, max 1000 producten per call.
     * Enkel gevonden records worden verwijderd, er vindt geen controle plaats op ProductId en/of WebsiteDomainId. Id's die niet gevonden worden, worden overgeslagen.
     *
     * @param array{
     *     ProductIds?: array<integer>|null,
     *     WebsiteDomainId?: integer|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function deleteWebsiteDomainForProducts(
        array $parameters = [],
    ): Logic4Response {
        return Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->delete('/v1/Products/DeleteWebsiteDomainForProducts', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg barcodes met aantallen o.b.v. een filter met artikel Id's.
     *
     * @param array<int> $parameters
     *
     * @throws Logic4ApiException
     */
    public function getBarcodesForProductIds(
        array $parameters = [],
    ): ProductBarcodeLogic4ResponseList {
        return ProductBarcodeLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Products/GetBarcodesForProductIds', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg basisinformatie van artikelen op basis van artikel Id's.
     *
     * @param array<int> $parameters
     *
     * @throws Logic4ApiException
     */
    public function getBasicProductDataForProducts(
        array $parameters = [],
    ): BasicProductDataLogic4ResponseList {
        return BasicProductDataLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Products/GetBasicProductDataForProducts', ['json' => $parameters]),
            )
        );
    }

    /**
     * Haal alle merken op.
     *
     * @throws Logic4ApiException
     *
     * @deprecated Let op! Versie 1.0 is verouderd. Gebruik versie v1.2. - Merken
     */
    public function getBrands(): BrandLogic4ResponseList
    {
        return BrandLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Products/GetBrands'),
            )
        );
    }

    /**
     * Verkrijg de inhoud van een samengesteld artikel.
     *
     * @throws Logic4ApiException
     */
    public function getComposedProductComposition(
        int $value,
    ): ProductCompositionItemLogic4ResponseList {
        return ProductCompositionItemLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Products/GetComposedProductComposition', ['json' => $value]),
            )
        );
    }

    /**
     * @throws Logic4ApiException
     */
    public function getPackageMaterialDepositTypes(
    ): PackingMaterialDepositTypeLogic4ResponseList {
        return PackingMaterialDepositTypeLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Products/GetPackageMaterialDepositTypes'),
            )
        );
    }

    /**
     * Verkrijg actuele prijzen voor een specifieke debiteur.
     *
     * @param array{
     *     ProductCode?: string|null,
     *     DebtorId?: integer|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getPriceInformationForProduct(
        array $parameters = [],
    ): ProductPriceInformationLogic4Response {
        return ProductPriceInformationLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Products/GetPriceInformationForProduct', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg alle prijslijsten o.b.v. het meegestuurde filter.
     *
     * @param array{
     *     PricelistId?: integer|null,
     *     DebtorId?: integer|null,
     *     LoadContractPrices?: boolean|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     *
     * @deprecated Let op! Versie 1.0 is verouderd. Gebruik een nieuwere versie. - Prijslijsten
     */
    public function getPricelists(
        array $parameters = [],
    ): ProductPricelistLogic4ResponseList {
        return ProductPricelistLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Products/GetPricelists', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg een standaard assemblagerecept voor een artikel.
     *
     * @throws Logic4ApiException
     */
    public function getProductAssemblyRecipe(
        int $value,
    ): ProductAssemblyRecipeItemLogic4ResponseList {
        return ProductAssemblyRecipeItemLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Products/GetProductAssemblyRecipe', ['json' => $value]),
            )
        );
    }

    /**
     * Verkrijg productcodes o.b.v. leverancier productcodes (maximaal 10000).
     *
     * @param array{
     *     SupplierId?: integer|null,
     *     SupplierCodes?: array<string>|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getProductCodesBySupplierProductCodes(
        array $parameters = [],
    ): ProductCodeWithSupplierCodeLogic4ResponseList {
        return ProductCodeWithSupplierCodeLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Products/GetProductCodesBySupplierProductCodes', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg de afmetingen van een product.
     *
     * @param array{
     *     ProductId?: integer|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getProductDimensions(
        array $parameters = [],
    ): ProductDimensionsLogic4Response {
        return ProductDimensionsLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Products/GetProductDimensions', ['json' => $parameters]),
            )
        );
    }

    /**
     * Haal ID's op van voorraadlocaties voor een bepaald product in een bepaald magazijn.
     *
     * @param array{
     *     ProductIds?: array<integer>|null,
     *     WarehouseId?: integer|null,
     *     SystemDefaultPickLocation?: boolean|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getProductPickStockLocationIds(
        array $parameters = [],
    ): ProductPickLocationBasedOnSystemSettingsLogic4ResponseList {
        return ProductPickLocationBasedOnSystemSettingsLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Products/GetProductPickStockLocationIds', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg geschreven reviews op basis van het opgestuurde filter.
     *
     * @param array{
     *     WebsiteDomainId?: integer|null,
     *     DateTimeCreatedFrom?: string|null,
     *     DateTimeCreatedTo?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getProductReviews(
        array $parameters = [],
    ): ProductReviewLogic4ResponseList {
        return ProductReviewLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Products/GetProductReviews', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg artikelen o.b.v. het meegestuurde filter.
     * Let op: Het maximum aantal records dat met één call opgehaald kan worden is 10000.
     * Het is verplicht om ten minste één type filtering toe te passen zodat het aantal records beperkt blijft.
     *
     * @param array{
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
     *
     * @deprecated Let op! Versie 1.0 is verouderd. Gebruik versie v1.2. - Artikelen ophalen
     */
    public function getProducts(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1/Products/GetProducts', $parameters);

        foreach ($iterator as $record) {
            yield ProductV11::make($record);
        }
    }

    /**
     * Verkrijg de verzendinformatie van een product.
     *
     * @param array{
     *     ProductId?: integer|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getProductShippingInformation(
        array $parameters = [],
    ): ProductShippingInformationLogic4Response {
        return ProductShippingInformationLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Products/GetProductShippingInformation', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg artikel Id's o.b.v. het meegestuurde filter.
     *
     * @param array{
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
     * @throws Logic4ApiException
     */
    public function getProductsIds(
        array $parameters = [],
    ): Int32Logic4ResponseList {
        return Int32Logic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Products/GetProductsIds', ['json' => $parameters]),
            )
        );
    }

    /**
     * @param array{
     *     ProductIds?: array<integer>|null,
     *     Skip?: integer|null,
     *     Take?: integer|null,
     * } $parameters
     *
     * @return \Generator<array-key, ProductVariantBalkChildrenGroup>
     *
     * @throws Logic4ApiException
     */
    public function getProductVariantBalkChildren(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1/Products/GetProductVariantBalkChildren', $parameters, 'Take', 'Skip');

        foreach ($iterator as $record) {
            yield ProductVariantBalkChildrenGroup::make($record);
        }
    }

    /**
     * Verkrijg alle productstatussen.
     *
     * @throws Logic4ApiException
     */
    public function getStatuses(): ProductStatusLogic4ResponseList
    {
        return ProductStatusLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Products/GetStatuses'),
            )
        );
    }

    /**
     * Verkrijg alle leveranciers van een product.
     *
     * @throws Logic4ApiException
     */
    public function getSuppliersForProduct(
        int $value,
    ): ProductSupplierLogic4ResponseList {
        return ProductSupplierLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Products/GetSuppliersForProduct', ['json' => $value]),
            )
        );
    }

    /**
     * Verkrijg alle leveranciers van één of meerdere producten op basis van ProductId's (max. 1000). Of gebruik 'TakeRecords' (max. 10.000).
     *
     * @param array{
     *     ProductIds?: array<integer>|null,
     *     SkipRecords?: integer|null,
     *     TakeRecords?: integer|null,
     * } $parameters
     *
     * @return \Generator<array-key, ProductSupplier>
     *
     * @throws Logic4ApiException
     */
    public function getSuppliersForProducts(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1/Products/GetSuppliersForProducts', $parameters);

        foreach ($iterator as $record) {
            yield ProductSupplier::make($record);
        }
    }

    /**
     * Verkrijg alle eenheden.
     *
     * @throws Logic4ApiException
     */
    public function getUnits(): ProductUnitLogic4ResponseList
    {
        return ProductUnitLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Products/GetUnits'),
            )
        );
    }

    /**
     * @param array{
     *     VariantBalkCategoryIds?: array<integer>|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getVariantbalkCategories(
        array $parameters = [],
    ): VariantBalkCategoryLogic4ResponseList {
        return VariantBalkCategoryLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Products/GetVariantbalkCategories', ['json' => $parameters]),
            )
        );
    }

    /**
     * @param array{
     *     VariantBalkIds?: array<integer>|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getVariantbalks(
        array $parameters = [],
    ): ProductVariantBalkLogic4ResponseList {
        return ProductVariantBalkLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Products/GetVariantbalks', ['json' => $parameters]),
            )
        );
    }

    /**
     * Het ophalen van gekoppelde webshops per product, max. 1000 producten per call.
     *
     * @param array{
     *     ProductIds?: array<integer>|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getWebsiteDomainsForProducts(
        array $parameters = [],
    ): WebsiteDomainsForProductLogic4ResponseList {
        return WebsiteDomainsForProductLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Products/GetWebsiteDomainsForProducts', ['json' => $parameters]),
            )
        );
    }

    /**
     * Als de combinatie van product, taal en webshopdomein nog niet bestaat wordt deze automatisch aangemaakt.
     * Webshopdomein mag null zijn, dan geldt de gegeven SEO informatie voor alle webhopdomeinen.
     * Bij het meegeven van 'null' voor informatie velden, wordt bestaande informatie leeg gehaald.
     * Als een product geen SEO informatie heeft voor een bepaald websitedomein en taal vindt er een fallback plaats op de basis informatie van het artikel.
     *
     * @param array{
     *     WebsiteDomainId?: integer|null,
     *     GlobalizationId?: integer|null,
     *     ProductId?: integer|null,
     *     Title?: string|null,
     *     Description?: string|null,
     *     USP?: string|null,
     *     MetaName?: string|null,
     *     MetaDescription?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function updateProductSEOInformation(
        array $parameters = [],
    ): Int32Logic4Response {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->patch('/v1/Products/UpdateProductSEOInformation', ['json' => $parameters]),
            )
        );
    }
}
