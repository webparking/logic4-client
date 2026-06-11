<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V10;

use Webparking\Logic4Client\Data\V10\ProductSupplier;
use Webparking\Logic4Client\Data\V10\ProductV11;
use Webparking\Logic4Client\Data\V10\ProductVariantBalkChildrenGroup;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V10\Logic4Response;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfBasicProductData;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfBrand;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfint;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfPackingMaterialDepositType;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfProductAssemblyRecipeItem;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfProductBarcode;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfProductCodeWithSupplierCode;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfProductCompositionItem;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfProductPickLocationBasedOnSystemSettings;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfProductPricelist;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfProductReview;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfProductStatus;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfProductSupplier;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfProductUnit;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfProductVariantBalk;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfVariantBalkCategory;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfWebsiteDomainsForProduct;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseOfboolean;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseOfint;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseOfProductDimensions;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseOfProductPriceInformation;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseOfProductShippingInformation;

class ProductRequest extends Request
{
    /**
     * Koppelen van een website aan een product, max 1000 producten per request.
     * Als een webshopdomein al reeds gekoppeld is, dan wordt deze overgeslagen.
     *
     * @param array{
     *     ProductIds?: array<int>,
     *     WebsiteDomainId?: int,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addWebsiteDomainForProducts(
        array $parameters = [],
    ): Logic4ResponseOfboolean {
        return Logic4ResponseOfboolean::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Products/AddWebsiteDomainForProducts', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verwijder een website dat gekoppeld zit aan een product, max 1000 producten per request.
     * Enkel gevonden records worden verwijderd, er vindt geen controle plaats op ProductId en/of WebsiteDomainId.
     * Id's die niet gevonden worden, worden overgeslagen.
     *
     * @param array{
     *     ProductIds?: array<int>,
     *     WebsiteDomainId?: int,
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
    ): Logic4ResponseListOfProductBarcode {
        return Logic4ResponseListOfProductBarcode::make(
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
    ): Logic4ResponseListOfBasicProductData {
        return Logic4ResponseListOfBasicProductData::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Products/GetBasicProductDataForProducts', ['json' => $parameters]),
            )
        );
    }

    /**
     * Haal alle merken op.
     *
     * @throws Logic4ApiException
     */
    public function getBrands(): Logic4ResponseListOfBrand
    {
        return Logic4ResponseListOfBrand::make(
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
    ): Logic4ResponseListOfProductCompositionItem {
        return Logic4ResponseListOfProductCompositionItem::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Products/GetComposedProductComposition', ['json' => $value]),
            )
        );
    }

    /**
     * Haal emballagetypen op.
     *
     * @throws Logic4ApiException
     */
    public function getPackageMaterialDepositTypes(
    ): Logic4ResponseListOfPackingMaterialDepositType {
        return Logic4ResponseListOfPackingMaterialDepositType::make(
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
     *     DebtorId?: int|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getPriceInformationForProduct(
        array $parameters = [],
    ): Logic4ResponseOfProductPriceInformation {
        return Logic4ResponseOfProductPriceInformation::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Products/GetPriceInformationForProduct', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg alle prijslijsten o.b.v. het meegestuurde filter.
     *
     * @param array{
     *     PricelistId?: int|null,
     *     DebtorId?: int|null,
     *     LoadContractPrices?: bool,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getPricelists(
        array $parameters = [],
    ): Logic4ResponseListOfProductPricelist {
        return Logic4ResponseListOfProductPricelist::make(
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
    ): Logic4ResponseListOfProductAssemblyRecipeItem {
        return Logic4ResponseListOfProductAssemblyRecipeItem::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Products/GetProductAssemblyRecipe', ['json' => $value]),
            )
        );
    }

    /**
     * Verkrijg productcodes o.b.v. leverancier productcodes (maximaal 10.000).
     *
     * @param array{
     *     SupplierId?: int,
     *     SupplierCodes?: array<string>,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getProductCodesBySupplierProductCodes(
        array $parameters = [],
    ): Logic4ResponseListOfProductCodeWithSupplierCode {
        return Logic4ResponseListOfProductCodeWithSupplierCode::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Products/GetProductCodesBySupplierProductCodes', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg de afmetingen van een artikel.
     *
     * @param array{
     *     ProductId?: int,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getProductDimensions(
        array $parameters = [],
    ): Logic4ResponseOfProductDimensions {
        return Logic4ResponseOfProductDimensions::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Products/GetProductDimensions', ['json' => $parameters]),
            )
        );
    }

    /**
     * Haal ID's op van voorraadlocaties voor een bepaald product in een bepaald magazijn.
     *
     * @param array{
     *     ProductIds?: array<int>,
     *     WarehouseId?: int|null,
     *     SystemDefaultPickLocation?: bool,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getProductPickStockLocationIds(
        array $parameters = [],
    ): Logic4ResponseListOfProductPickLocationBasedOnSystemSettings {
        return Logic4ResponseListOfProductPickLocationBasedOnSystemSettings::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Products/GetProductPickStockLocationIds', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg geschreven reviews op basis van het opgestuurde filter.
     *
     * @param array{
     *     WebsiteDomainId?: int|null,
     *     DateTimeCreatedFrom?: string|null,
     *     DateTimeCreatedTo?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getProductReviews(
        array $parameters = [],
    ): Logic4ResponseListOfProductReview {
        return Logic4ResponseListOfProductReview::make(
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
     *     ProductFilterListChoice?: mixed,
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
     *     FromId?: int|null,
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
        $iterator = $this->paginateRecords('/v1/Products/GetProducts', $parameters);

        foreach ($iterator as $record) {
            yield ProductV11::make($record);
        }
    }

    /**
     * Verkrijg de verzendinformatie van een product.
     *
     * @param array{
     *     ProductId?: int,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getProductShippingInformation(
        array $parameters = [],
    ): Logic4ResponseOfProductShippingInformation {
        return Logic4ResponseOfProductShippingInformation::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Products/GetProductShippingInformation', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg artikel Id's o.b.v. het meegestuurde filter.
     *
     * @param array{
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
     *     ProductFilterListChoice?: mixed,
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
     *     FromId?: int|null,
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
     * @throws Logic4ApiException
     */
    public function getProductsIds(
        array $parameters = [],
    ): Logic4ResponseListOfint {
        return Logic4ResponseListOfint::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Products/GetProductsIds', ['json' => $parameters]),
            )
        );
    }

    /**
     * @param array{
     *     ProductIds?: array<int>,
     *     Skip?: int|null,
     *     Take?: int|null,
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
    public function getStatuses(): Logic4ResponseListOfProductStatus
    {
        return Logic4ResponseListOfProductStatus::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Products/GetStatuses'),
            )
        );
    }

    /**
     * Verkrijg alle leveranciers van één product.
     *
     * @throws Logic4ApiException
     */
    public function getSuppliersForProduct(
        int $value,
    ): Logic4ResponseListOfProductSupplier {
        return Logic4ResponseListOfProductSupplier::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Products/GetSuppliersForProduct', ['json' => $value]),
            )
        );
    }

    /**
     * Verkrijg alle leveranciers van één of meerdere producten op basis van ProductId's (max. 1000). Of gebruik 'TakeRecords' (max. 10.000).
     *
     * @param array{
     *     ProductIds?: array<int>,
     *     SkipRecords?: int,
     *     TakeRecords?: int,
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
    public function getUnits(): Logic4ResponseListOfProductUnit
    {
        return Logic4ResponseListOfProductUnit::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Products/GetUnits'),
            )
        );
    }

    /**
     * Haal artikel variantbalk categorie gegevens op, waaronder de mogelijke waarden en vertalingen.
     *
     * @param array{
     *     VariantBalkCategoryIds?: array<int>,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getVariantbalkCategories(
        array $parameters = [],
    ): Logic4ResponseListOfVariantBalkCategory {
        return Logic4ResponseListOfVariantBalkCategory::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Products/GetVariantbalkCategories', ['json' => $parameters]),
            )
        );
    }

    /**
     * Haal artikel variantbalk gegevens op, waaronder de mogelijke waarden, vertalingen en de categorieën.
     * Voor nieuwe vertalingen kan het maximaal 10 minuten duren voordat deze terugkomen in de resultaten.
     *
     * @param array{
     *     VariantBalkIds?: array<int>,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getVariantbalks(
        array $parameters = [],
    ): Logic4ResponseListOfProductVariantBalk {
        return Logic4ResponseListOfProductVariantBalk::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Products/GetVariantbalks', ['json' => $parameters]),
            )
        );
    }

    /**
     * Het ophalen van gekoppelde webshops per product, max. 1000 producten per request.
     *
     * @param array{
     *     ProductIds?: array<int>,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getWebsiteDomainsForProducts(
        array $parameters = [],
    ): Logic4ResponseListOfWebsiteDomainsForProduct {
        return Logic4ResponseListOfWebsiteDomainsForProduct::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Products/GetWebsiteDomainsForProducts', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verander de SEO informatie voor een product op basis van taal en webshopdomein.
     * Een SEO informatie record wordt op basis van een combinatie van ProductId, GlobalizationId en WebsiteDomainId geselecteerd.
     * WebsiteDomainId mag null zijn, dan geldt de gegeven SEO informatie voor alle webhopdomeinen.
     * <br />
     * Als een record niet bestaat wordt deze aangemaakt. Lege records worden automatisch verwijderd.
     * Niet-lege records moeten ten minste een Title of Description hebben.
     * <br />
     * Bij het meegeven van een lege string of 'null' voor informatievelden, wordt bestaande informatie leeg gehaald.
     * Velden die niet in de request staan worden niet gewijzigd.
     * <br />
     * Als een product geen SEO informatie heeft voor een bepaalde taal en webshopdomein vindt er een fallback plaats op de basisinformatie van het artikel.
     *
     * @param array{
     *     WebsiteDomainId?: int|null,
     *     GlobalizationId?: int,
     *     ProductId?: int,
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
    ): Logic4ResponseOfint {
        return Logic4ResponseOfint::make(
            $this->buildResponse(
                $this->getClient()->patch('/v1/Products/UpdateProductSEOInformation', ['json' => $parameters]),
            )
        );
    }
}
