<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V11;

use Webparking\Logic4Client\Data\V11\ProductSupplier;
use Webparking\Logic4Client\Data\V11\ProductV11;
use Webparking\Logic4Client\Data\V11\ProductVariantBalkChildrenGroup;
use Webparking\Logic4Client\Data\V11\ProductWithRelatedProducts;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V11\Logic4ResponseListOfBasicProductData;
use Webparking\Logic4Client\Responses\V11\Logic4ResponseListOfBrand;
use Webparking\Logic4Client\Responses\V11\Logic4ResponseListOfGetProductImage;
use Webparking\Logic4Client\Responses\V11\Logic4ResponseListOfint;
use Webparking\Logic4Client\Responses\V11\Logic4ResponseListOfProductAssemblyRecipeItem;
use Webparking\Logic4Client\Responses\V11\Logic4ResponseListOfProductBarcode;
use Webparking\Logic4Client\Responses\V11\Logic4ResponseListOfProductCompositionItem;
use Webparking\Logic4Client\Responses\V11\Logic4ResponseListOfProductPickLocationBasedOnSystemSettings;
use Webparking\Logic4Client\Responses\V11\Logic4ResponseListOfProductPricelist;
use Webparking\Logic4Client\Responses\V11\Logic4ResponseListOfProductReview;
use Webparking\Logic4Client\Responses\V11\Logic4ResponseListOfProductSEOInformation;
use Webparking\Logic4Client\Responses\V11\Logic4ResponseListOfProductStatus;
use Webparking\Logic4Client\Responses\V11\Logic4ResponseListOfProductSupplier;
use Webparking\Logic4Client\Responses\V11\Logic4ResponseListOfProductUnit;
use Webparking\Logic4Client\Responses\V11\Logic4ResponseOfint;
use Webparking\Logic4Client\Responses\V11\Logic4ResponseOfProductPriceInformation;
use Webparking\Logic4Client\Responses\V11\ProductExtraBarcodeType;

class ProductRequest extends Request
{
    /**
     * Toevoegen van een product.
     * Geeft een productId terug als resultaat indien het opslaan goed is verlopen.
     *
     * @param array{
     *     ProductCode?: string|null,
     *     ProductDescription1?: string|null,
     *     ProductDescription2?: string|null,
     *     BrandId?: int,
     *     ProductGroup1?: int,
     *     ProductGroup2?: int|null,
     *     ProductGroup3?: int|null,
     *     ProductGroup4?: int|null,
     *     UnitId?: int,
     *     Suppliers?: array<array{SupplierId?: int, Supplier_ProductCode?: string|null, ProductName?: string|null, ProductCountIncrement?: int|null, ShippingTime?: int|null, MinOrderQuantity?: int|null, RepackagingUnitId?: int|null, RepackagingQty?: int|null, InternalNote?: string|null, DiscountGroupId?: int|null, ProductPrices?: array<array{BuyPrice?: number, SellPrice?: number|null, Quantity?: int, LastSyncDate?: string}>}>,
     *     Barcode1?: string|null,
     *     Barcode2?: string|null,
     *     ExtraBarcodes?: array<array{Barcode?: string|null, Quantity?: int, UnitId?: int|null}>,
     *     VendorCode?: string|null,
     *     StatusId?: int,
     *     VisibleOnWebshopFrom?: string|null,
     *     ExpirationDateOnWebshop?: string|null,
     *     WarrantyMonths?: int|null,
     *     SortId?: int|null,
     *     InternalNote?: string|null,
     *     ProductInfo?: string|null,
     *     Tags?: string|null,
     *     USPDescription?: string|null,
     *     MetaDescription?: string|null,
     *     SellPriceAdviceEx?: number|null,
     *     FreeValue1?: string|null,
     *     FreeValue2?: string|null,
     *     FreeValue3?: string|null,
     *     FreeValue4?: string|null,
     *     FreeValue5?: string|null,
     *     ProductPrices?: array<array{Quantity?: int, BuyPrice?: number, SellPrice?: number}>,
     *     WeightSingleProduct?: number,
     *     HeightSingleProduct?: number,
     *     WidthSingleProduct?: number,
     *     DepthSingleProduct?: number,
     *     WeightInsidePackage?: number,
     *     HeightInsidePackage?: number,
     *     WidthInsidePackage?: number,
     *     DepthInsidePackage?: number,
     *     WeightOutsidePackage?: number,
     *     HeightOutsidePackage?: number,
     *     WidthOutsidePackage?: number,
     *     DepthOutsidePackage?: number,
     *     MinStockCount?: int|null,
     *     MaxStockCount?: int|null,
     *     HidePricesOnWebsite?: bool,
     *     ShowOfferButtonOnWebsite?: bool,
     *     HideStartingPricesOnWebsite?: bool,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addProduct(array $parameters = []): Logic4ResponseOfint
    {
        return Logic4ResponseOfint::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.1/Products/AddProduct', ['json' => $parameters]),
            )
        );
    }

    /**
     * Voeg een afbeelding toe aan het artikel
     * - Maximale grootte van het bericht is 5MB
     * - Return waarde is een AfbeeldingId als de opdracht is geslaagd.
     *
     * @param array{
     *     ImageBase64String?: string|null,
     *     ProductId?: int,
     *     ImageName?: string|null,
     *     ImageId?: int|null,
     *     SortId?: int|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addProductImage(array $parameters = []): Logic4ResponseOfint
    {
        return Logic4ResponseOfint::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.1/Products/AddProductImage', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verwijder een afbeelding van het artikel.
     *
     * @throws Logic4ApiException
     */
    public function deleteProductImage(
        int $productid,
        int $imageid,
    ): Logic4ResponseOfint {
        return Logic4ResponseOfint::make(
            $this->buildResponse(
                $this->getClient()->delete('/v1.1/Products/DeleteProductImage', ['query' => ['productid' => $productid, 'imageid' => $imageid]]),
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
                $this->getClient()->post('/v1.1/Products/GetBarcodesForProductIds', ['json' => $parameters]),
            )
        );
    }

    /**
     * Haal artikel barcode types op.
     * Deze types worden gebruikt in bijvoorbeeld de UpdateProductAddExtraBarcode functionaliteit.
     *
     * @return array<array-key, ProductExtraBarcodeType>
     *
     * @throws Logic4ApiException
     */
    public function getBarcodeTypes(): array
    {
        return array_map(
            static fn (array $data) => ProductExtraBarcodeType::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v1.1/Products/GetBarcodeTypes'),
            ),
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
                $this->getClient()->post('/v1.1/Products/GetBasicProductDataForProducts', ['json' => $parameters]),
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
                $this->getClient()->get('/v1.1/Products/GetBrands'),
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
                $this->getClient()->post('/v1.1/Products/GetComposedProductComposition', ['json' => $value]),
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
                $this->getClient()->post('/v1.1/Products/GetPriceInformationForProduct', ['json' => $parameters]),
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
                $this->getClient()->post('/v1.1/Products/GetPricelists', ['json' => $parameters]),
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
                $this->getClient()->post('/v1.1/Products/GetProductAssemblyRecipe', ['json' => $value]),
            )
        );
    }

    /**
     * Haal de afbeeldinginformatie op van een artikel.
     *
     * @throws Logic4ApiException
     */
    public function getProductImages(
        int $productid,
    ): Logic4ResponseListOfGetProductImage {
        return Logic4ResponseListOfGetProductImage::make(
            $this->buildResponse(
                $this->getClient()->get('/v1.1/Products/GetProductImages', ['query' => ['productid' => $productid]]),
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
                $this->getClient()->post('/v1.1/Products/GetProductPickStockLocationIds', ['json' => $parameters]),
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
                $this->getClient()->post('/v1.1/Products/GetProductReviews', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg artikelen o.b.v. het meegestuurde filter. Het aantal op te vragen artikelen is gelimiteerd tot 10000.
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
        $iterator = $this->paginateRecords('/v1.1/Products/GetProducts', $parameters);

        foreach ($iterator as $record) {
            yield ProductV11::make($record);
        }
    }

    /**
     * Verkrijg SEO informatie voor 1 of meerdere artikelen.
     *
     * @param array{
     *     WebsiteDomainId?: int|null,
     *     GlobalizationId?: int|null,
     *     ProductId?: int|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getProductSEOInformations(
        array $parameters = [],
    ): Logic4ResponseListOfProductSEOInformation {
        return Logic4ResponseListOfProductSEOInformation::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.1/Products/GetProductSEOInformations', ['json' => $parameters]),
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
                $this->getClient()->post('/v1.1/Products/GetProductsIds', ['json' => $parameters]),
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
        $iterator = $this->paginateRecords('/v1.1/Products/GetProductVariantBalkChildren', $parameters, 'Take', 'Skip');

        foreach ($iterator as $record) {
            yield ProductVariantBalkChildrenGroup::make($record);
        }
    }

    /**
     * Haal gerelateerde artikelen op.
     *
     * @param array{
     *     ProductIds?: array<int>,
     *     RelatedTypeId?: int|null,
     *     Skip?: int|null,
     *     Take?: int|null,
     * } $parameters
     *
     * @return \Generator<array-key, ProductWithRelatedProducts>
     *
     * @throws Logic4ApiException
     */
    public function getRelatedProducts(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1.1/Products/GetRelatedProducts', $parameters, 'Take', 'Skip');

        foreach ($iterator as $record) {
            yield ProductWithRelatedProducts::make($record);
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
                $this->getClient()->get('/v1.1/Products/GetStatuses'),
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
                $this->getClient()->post('/v1.1/Products/GetSuppliersForProduct', ['json' => $value]),
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
        $iterator = $this->paginateRecords('/v1.1/Products/GetSuppliersForProducts', $parameters);

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
                $this->getClient()->get('/v1.1/Products/GetUnits'),
            )
        );
    }

    /**
     * Verwijder een leverancier voor een artikel.
     * Geeft een productId terug als resultaat indien het verwijderen goed is verlopen.
     *
     * @param array{
     *     SupplierId?: int,
     *     ProductId?: int,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function removeProductSupplier(
        array $parameters = [],
    ): Logic4ResponseOfint {
        return Logic4ResponseOfint::make(
            $this->buildResponse(
                $this->getClient()->delete('/v1.1/Products/RemoveProductSupplier', ['json' => $parameters]),
            )
        );
    }

    /**
     * Maak een leverancier voor een artikel actief.
     * Geeft een productId terug als resultaat indien het opslaan goed is verlopen.
     * Voor deze aanroep zijn extra rechten vereist.
     *
     * @param array{
     *     SupplierId?: int,
     *     ProductId?: int,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function setActiveProductSupplier(
        array $parameters = [],
    ): Logic4ResponseOfint {
        return Logic4ResponseOfint::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.1/Products/SetActiveProductSupplier', ['json' => $parameters]),
            )
        );
    }

    /**
     * Updaten van een product.
     * Geeft een productId terug als resultaat indien het opslaan goed is verlopen.
     *
     * @param array{
     *     ProductId?: int,
     *     ProductDescription1?: string|null,
     *     ProductDescription2?: string|null,
     *     ProductGroup2?: int|null,
     *     ProductGroup3?: int|null,
     *     ProductGroup4?: int|null,
     *     UnitId?: int|null,
     *     Barcode1?: string|null,
     *     Barcode2?: string|null,
     *     VendorCode?: string|null,
     *     StatusId?: int|null,
     *     VisibleOnWebshopFrom?: string|null,
     *     ExpirationDateOnWebshop?: string|null,
     *     WarrantyMonths?: int|null,
     *     SortId?: int|null,
     *     InternalNote?: string|null,
     *     ProductInfo?: string|null,
     *     Tags?: string|null,
     *     USPDescription?: string|null,
     *     MetaDescription?: string|null,
     *     SellPriceAdviceEx?: number|null,
     *     FreeValue1?: string|null,
     *     FreeValue2?: string|null,
     *     FreeValue3?: string|null,
     *     FreeValue4?: string|null,
     *     FreeValue5?: string|null,
     *     WeightSingleProduct?: number|null,
     *     HeightSingleProduct?: number|null,
     *     WidthSingleProduct?: number|null,
     *     DepthSingleProduct?: number|null,
     *     WeightInsidePackage?: number|null,
     *     HeightInsidePackage?: number|null,
     *     WidthInsidePackage?: number|null,
     *     DepthInsidePackage?: number|null,
     *     WeightOutsidePackage?: number|null,
     *     HeightOutsidePackage?: number|null,
     *     WidthOutsidePackage?: number|null,
     *     DepthOutsidePackage?: number|null,
     *     MinStockCount?: int|null,
     *     MaxStockCount?: int|null,
     *     TemplateId?: int|null,
     *     HidePricesOnWebsite?: bool,
     *     ShowOfferButtonOnWebsite?: bool,
     *     HideStartingPricesOnWebsite?: bool,
     *     OfferStartDate?: string|null,
     *     OfferEndDate?: string|null,
     *     OfferFromPrice?: number|null,
     *     OfferToPrice?: number|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function updateProduct(array $parameters = []): Logic4ResponseOfint
    {
        return Logic4ResponseOfint::make(
            $this->buildResponse(
                $this->getClient()->patch('/v1.1/Products/UpdateProduct', ['json' => $parameters]),
            )
        );
    }

    /**
     * Voeg een barcode toe aan een artikel
     * Geeft een productId terug als resultaat indien het opslaan goed is verlopen.
     *
     * @param array{
     *     ProductId?: int,
     *     TypeId?: int|null,
     *     Barcode?: string|null,
     *     Quantity?: int,
     *     UnitId?: int|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function updateProductAddExtraBarcode(
        array $parameters = [],
    ): Logic4ResponseOfint {
        return Logic4ResponseOfint::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.1/Products/UpdateProductAddExtraBarcode', ['json' => $parameters]),
            )
        );
    }

    /**
     * Update een afbeelding van het artikel
     * - Maximale grootte van het bericht is 5MB
     * - Return waarde is een AfbeeldingId als de opdracht is geslaagd.
     *
     * @param array{
     *     ImageBase64String?: string|null,
     *     ProductId?: int,
     *     ImageName?: string|null,
     *     ImageId?: int,
     *     SortId?: int|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function updateProductImage(
        array $parameters = [],
    ): Logic4ResponseOfint {
        return Logic4ResponseOfint::make(
            $this->buildResponse(
                $this->getClient()->put('/v1.1/Products/UpdateProductImage', ['json' => $parameters]),
            )
        );
    }

    /**
     * Updaten van de artikel hoofdgroep en merk.
     * Voor deze aanroep zijn extra rechten vereist.
     *
     * @param array{
     *     ProductGroup1Id?: int,
     *     BrandId?: int,
     *     ProductId?: int,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function updateProductMainGroupAndBrand(
        array $parameters = [],
    ): Logic4ResponseOfint {
        return Logic4ResponseOfint::make(
            $this->buildResponse(
                $this->getClient()->patch('/v1.1/Products/UpdateProductMainGroupAndBrand', ['json' => $parameters]),
            )
        );
    }

    /**
     * Updaten van de artikel staffel prijzen.
     * Geeft een productId terug als resultaat indien het opslaan goed is verlopen.
     * Niet aangeleverde staffels zullen automatisch worden verwijderd.
     * Voor deze aanroep zijn extra rechten vereist.
     *
     * @param array{
     *     ProductPrices?: array<array{Quantity?: int, BuyPrice?: number, SellPrice?: number}>,
     *     ProductId?: int,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function updateProductPrices(
        array $parameters = [],
    ): Logic4ResponseOfint {
        return Logic4ResponseOfint::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.1/Products/UpdateProductPrices', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verwijder een barcode van een artikel
     * Geeft een productId terug als resultaat indien het opslaan goed is verlopen.
     *
     * @param array{
     *     ProductId?: int,
     *     Barcode?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function updateProductRemoveExtraBarcode(
        array $parameters = [],
    ): Logic4ResponseOfint {
        return Logic4ResponseOfint::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.1/Products/UpdateProductRemoveExtraBarcode', ['json' => $parameters]),
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
                $this->getClient()->patch('/v1.1/Products/UpdateProductSEOInformation', ['json' => $parameters]),
            )
        );
    }

    /**
     * Updaten van de artikel leverancier.
     * Geeft een productId terug als resultaat indien het opslaan goed is verlopen.
     *
     * @param array{
     *     Supplier_ProductCode?: string|null,
     *     ProductName?: string|null,
     *     ProductCountIncrement?: int|null,
     *     ShippingTime?: int|null,
     *     MinOrderQuantity?: int|null,
     *     RepackagingQty?: int|null,
     *     RepackagingUnitId?: int|null,
     *     InternalNote?: string|null,
     *     SupplierId?: int,
     *     ProductId?: int,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function updateProductSupplier(
        array $parameters = [],
    ): Logic4ResponseOfint {
        return Logic4ResponseOfint::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.1/Products/UpdateProductSupplier', ['json' => $parameters]),
            )
        );
    }

    /**
     * Update de prijzen van de leverancier. Geeft een productId terug als resultaat.
     *
     * @param array{
     *     ProductId?: int,
     *     SupplierId?: int,
     *     ProductPrices?: array<array{BuyPrice?: number, SellPrice?: number|null, Quantity?: int, LastSyncDate?: string}>,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function updateProductSupplierProductPrice(
        array $parameters = [],
    ): Logic4ResponseOfint {
        return Logic4ResponseOfint::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.1/Products/UpdateProductSupplierProductPrice', ['json' => $parameters]),
            )
        );
    }
}
