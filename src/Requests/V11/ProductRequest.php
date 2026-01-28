<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V11;

use Webparking\Logic4Client\Data\V11\ProductSupplier;
use Webparking\Logic4Client\Data\V11\ProductV11;
use Webparking\Logic4Client\Data\V11\ProductVariantBalkChildrenGroup;
use Webparking\Logic4Client\Data\V11\ProductWithRelatedProducts;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V11\BasicProductDataLogic4ResponseList;
use Webparking\Logic4Client\Responses\V11\BrandLogic4ResponseList;
use Webparking\Logic4Client\Responses\V11\GetProductImageLogic4ResponseList;
use Webparking\Logic4Client\Responses\V11\Int32Logic4Response;
use Webparking\Logic4Client\Responses\V11\Int32Logic4ResponseList;
use Webparking\Logic4Client\Responses\V11\ProductAssemblyRecipeItemLogic4ResponseList;
use Webparking\Logic4Client\Responses\V11\ProductBarcodeLogic4ResponseList;
use Webparking\Logic4Client\Responses\V11\ProductCompositionItemLogic4ResponseList;
use Webparking\Logic4Client\Responses\V11\ProductExtraBarcodeType;
use Webparking\Logic4Client\Responses\V11\ProductPickLocationBasedOnSystemSettingsLogic4ResponseList;
use Webparking\Logic4Client\Responses\V11\ProductPriceInformationLogic4Response;
use Webparking\Logic4Client\Responses\V11\ProductPricelistLogic4ResponseList;
use Webparking\Logic4Client\Responses\V11\ProductReviewLogic4ResponseList;
use Webparking\Logic4Client\Responses\V11\ProductSEOInformationLogic4ResponseList;
use Webparking\Logic4Client\Responses\V11\ProductStatusLogic4ResponseList;
use Webparking\Logic4Client\Responses\V11\ProductSupplierLogic4ResponseList;
use Webparking\Logic4Client\Responses\V11\ProductUnitLogic4ResponseList;

class ProductRequest extends Request
{
    /**
     * @param array{
     *     ProductCode?: string|null,
     *     ProductDescription1?: string|null,
     *     ProductDescription2?: string|null,
     *     BrandId?: int|null,
     *     ProductGroup1?: int|null,
     *     ProductGroup2?: int|null,
     *     ProductGroup3?: int|null,
     *     ProductGroup4?: int|null,
     *     UnitId?: int|null,
     *     Suppliers?: array<array{SupplierId?: int, Supplier_ProductCode?: string|null, ProductName?: string|null, ProductCountIncrement?: int|null, ShippingTime?: int|null, MinOrderQuantity?: int|null, RepackagingUnitId?: int|null, RepackagingQty?: int|null, InternalNote?: string|null, DiscountGroupId?: int|null, ProductPrices?: array<array{BuyPrice?: number, SellPrice?: number|null, Quantity?: int, LastSyncDate?: string}>|null}>|null,
     *     Barcode1?: string|null,
     *     Barcode2?: string|null,
     *     ExtraBarcodes?: array<array{Barcode?: string, Quantity?: int, UnitId?: int|null}>|null,
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
     *     ProductPrices?: array<array{Quantity?: int, BuyPrice?: number, SellPrice?: number}>|null,
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
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addProduct(array $parameters = []): Int32Logic4Response
    {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.1/Products/AddProduct', ['json' => $parameters]),
            )
        );
    }

    /**
     * - Maximale grootte van het bericht is 5MB
     * - Return waarde is een AfbeeldingId als de opdracht is geslaagd.
     *
     * @param array{
     *     ImageBase64String?: string|null,
     *     ProductId?: int|null,
     *     ImageName?: string|null,
     *     ImageId?: int|null,
     *     SortId?: int|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addProductImage(array $parameters = []): Int32Logic4Response
    {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.1/Products/AddProductImage', ['json' => $parameters]),
            )
        );
    }

    /**
     * @throws Logic4ApiException
     */
    public function deleteProductImage(
        int $productid,
        int $imageid,
    ): Int32Logic4Response {
        return Int32Logic4Response::make(
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
    ): ProductBarcodeLogic4ResponseList {
        return ProductBarcodeLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.1/Products/GetBarcodesForProductIds', ['json' => $parameters]),
            )
        );
    }

    /**
     * @return array<array-key, ProductExtraBarcodeType>
     *
     * @throws Logic4ApiException
     *
     * @deprecated Let op! Versie 1.1 is verouderd. Gebruik versie v1.2. - Haal artikel barcode types op.
     * Deze types worden gebruikt in bijvoorbeeld de UpdateProductAddExtraBarcode functionaliteit.
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
    ): BasicProductDataLogic4ResponseList {
        return BasicProductDataLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.1/Products/GetBasicProductDataForProducts', ['json' => $parameters]),
            )
        );
    }

    /**
     * Haal alle merken op.
     *
     * @throws Logic4ApiException
     *
     * @deprecated Let op! Versie 1.1 is verouderd. Gebruik versie v1.2. - Merken
     */
    public function getBrands(): BrandLogic4ResponseList
    {
        return BrandLogic4ResponseList::make(
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
    ): ProductCompositionItemLogic4ResponseList {
        return ProductCompositionItemLogic4ResponseList::make(
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
    ): ProductPriceInformationLogic4Response {
        return ProductPriceInformationLogic4Response::make(
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
     *     LoadContractPrices?: bool|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     *
     * @deprecated Let op! Versie 1.1 is verouderd. Gebruik een nieuwere versie. - Prijslijsten
     */
    public function getPricelists(
        array $parameters = [],
    ): ProductPricelistLogic4ResponseList {
        return ProductPricelistLogic4ResponseList::make(
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
    ): ProductAssemblyRecipeItemLogic4ResponseList {
        return ProductAssemblyRecipeItemLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.1/Products/GetProductAssemblyRecipe', ['json' => $value]),
            )
        );
    }

    /**
     * @throws Logic4ApiException
     *
     * @deprecated Let op! Versie 1.1 is verouderd. Gebruik versie v2.0. - Haal de afbeeldinginformatie op van een artikel
     */
    public function getProductImages(
        int $productid,
    ): GetProductImageLogic4ResponseList {
        return GetProductImageLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1.1/Products/GetProductImages', ['query' => ['productid' => $productid]]),
            )
        );
    }

    /**
     * Haal ID's op van voorraadlocaties voor een bepaald product in een bepaald magazijn.
     *
     * @param array{
     *     ProductIds?: array<int>|null,
     *     WarehouseId?: int|null,
     *     SystemDefaultPickLocation?: bool|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getProductPickStockLocationIds(
        array $parameters = [],
    ): ProductPickLocationBasedOnSystemSettingsLogic4ResponseList {
        return ProductPickLocationBasedOnSystemSettingsLogic4ResponseList::make(
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
    ): ProductReviewLogic4ResponseList {
        return ProductReviewLogic4ResponseList::make(
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
     *
     * @deprecated Let op! Versie 1.1 is verouderd. Gebruik een nieuwere versie. - SEO informatie voor artikel
     */
    public function getProductSEOInformations(
        array $parameters = [],
    ): ProductSEOInformationLogic4ResponseList {
        return ProductSEOInformationLogic4ResponseList::make(
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
     * @throws Logic4ApiException
     */
    public function getProductsIds(
        array $parameters = [],
    ): Int32Logic4ResponseList {
        return Int32Logic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.1/Products/GetProductsIds', ['json' => $parameters]),
            )
        );
    }

    /**
     * @param array{
     *     ProductIds?: array<int>|null,
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
     * @param array{
     *     ProductIds?: array<int>|null,
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
    public function getStatuses(): ProductStatusLogic4ResponseList
    {
        return ProductStatusLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1.1/Products/GetStatuses'),
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
                $this->getClient()->post('/v1.1/Products/GetSuppliersForProduct', ['json' => $value]),
            )
        );
    }

    /**
     * Verkrijg alle leveranciers van één of meerdere producten op basis van ProductId's (max. 1000). Of gebruik 'TakeRecords' (max. 10.000).
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
    public function getUnits(): ProductUnitLogic4ResponseList
    {
        return ProductUnitLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1.1/Products/GetUnits'),
            )
        );
    }

    /**
     * @param array{
     *     SupplierId?: int|null,
     *     ProductId?: int|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function removeProductSupplier(
        array $parameters = [],
    ): Int32Logic4Response {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->delete('/v1.1/Products/RemoveProductSupplier', ['json' => $parameters]),
            )
        );
    }

    /**
     * Voor deze aanroep zijn extra rechten vereist.
     *
     * @param array{
     *     SupplierId?: int|null,
     *     ProductId?: int|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function setActiveProductSupplier(
        array $parameters = [],
    ): Int32Logic4Response {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.1/Products/SetActiveProductSupplier', ['json' => $parameters]),
            )
        );
    }

    /**
     * @param array{
     *     ProductId?: int|null,
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
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function updateProduct(array $parameters = []): Int32Logic4Response
    {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->patch('/v1.1/Products/UpdateProduct', ['json' => $parameters]),
            )
        );
    }

    /**
     * @param array{
     *     ProductId?: int|null,
     *     TypeId?: int|null,
     *     Barcode?: string|null,
     *     Quantity?: int|null,
     *     UnitId?: int|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function updateProductAddExtraBarcode(
        array $parameters = [],
    ): Int32Logic4Response {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.1/Products/UpdateProductAddExtraBarcode', ['json' => $parameters]),
            )
        );
    }

    /**
     * - Maximale grootte van het bericht is 5MB
     * - Return waarde is een AfbeeldingId als de opdracht is geslaagd.
     *
     * @param array{
     *     ImageBase64String?: string|null,
     *     ProductId?: int|null,
     *     ImageName?: string|null,
     *     ImageId?: int|null,
     *     SortId?: int|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function updateProductImage(
        array $parameters = [],
    ): Int32Logic4Response {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->put('/v1.1/Products/UpdateProductImage', ['json' => $parameters]),
            )
        );
    }

    /**
     * Voor deze aanroep zijn extra rechten vereist.
     *
     * @param array{
     *     ProductGroup1Id?: int|null,
     *     BrandId?: int|null,
     *     ProductId?: int|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function updateProductMainGroupAndBrand(
        array $parameters = [],
    ): Int32Logic4Response {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->patch('/v1.1/Products/UpdateProductMainGroupAndBrand', ['json' => $parameters]),
            )
        );
    }

    /**
     * Voor deze aanroep zijn extra rechten vereist.
     *
     * @param array{
     *     ProductPrices?: array<array{Quantity?: int, BuyPrice?: number, SellPrice?: number}>|null,
     *     ProductId?: int|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function updateProductPrices(
        array $parameters = [],
    ): Int32Logic4Response {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.1/Products/UpdateProductPrices', ['json' => $parameters]),
            )
        );
    }

    /**
     * @param array{
     *     ProductId?: int|null,
     *     Barcode?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function updateProductRemoveExtraBarcode(
        array $parameters = [],
    ): Int32Logic4Response {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.1/Products/UpdateProductRemoveExtraBarcode', ['json' => $parameters]),
            )
        );
    }

    /**
     * Een SEO informatie record word op basis van een combinatie van ProductId, GlobalizationId en WebsiteDomainId geselecteerd.
     * WebsiteDomainId mag null zijn, dan geldt de gegeven SEO informatie voor alle webhopdomeinen.
     *
     * Als een record niet bestaat wordt deze aangemaakt. Lege records worden automatisch verwijdert.
     * Niet-lege records moeten ten minste een Title of Description hebben.
     *
     *
     * Bij het meegeven van een lege string of 'null' voor informatie velden, wordt bestaande informatie leeg gehaald.
     * Velden die niet in de request staan worden niet gewijzigd.
     *
     *
     * Als een product geen SEO informatie heeft voor een bepaalde taal en webshopdomein vindt er een fallback plaats op de basis informatie van het artikel.
     *
     * @param array{
     *     WebsiteDomainId?: int|null,
     *     GlobalizationId?: int|null,
     *     ProductId?: int|null,
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
                $this->getClient()->patch('/v1.1/Products/UpdateProductSEOInformation', ['json' => $parameters]),
            )
        );
    }

    /**
     * @param array{
     *     Supplier_ProductCode?: string|null,
     *     ProductName?: string|null,
     *     ProductCountIncrement?: int|null,
     *     ShippingTime?: int|null,
     *     MinOrderQuantity?: int|null,
     *     RepackagingQty?: int|null,
     *     RepackagingUnitId?: int|null,
     *     InternalNote?: string|null,
     *     SupplierId?: int|null,
     *     ProductId?: int|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function updateProductSupplier(
        array $parameters = [],
    ): Int32Logic4Response {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.1/Products/UpdateProductSupplier', ['json' => $parameters]),
            )
        );
    }

    /**
     * @param array{
     *     ProductId?: int|null,
     *     SupplierId?: int|null,
     *     ProductPrices?: array<array{BuyPrice?: number, SellPrice?: number|null, Quantity?: int, LastSyncDate?: string}>|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function updateProductSupplierProductPrice(
        array $parameters = [],
    ): Int32Logic4Response {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.1/Products/UpdateProductSupplierProductPrice', ['json' => $parameters]),
            )
        );
    }
}
