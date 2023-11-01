<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests;

use Webparking\Logic4Client\Data\Brand;
use Webparking\Logic4Client\Data\ProductSEOInformation;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\PaginatedResponse;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\BasicProductDataLogic4ResponseList;
use Webparking\Logic4Client\Responses\Int32Logic4Response;
use Webparking\Logic4Client\Responses\Int32Logic4ResponseList;
use Webparking\Logic4Client\Responses\Logic4Response;
use Webparking\Logic4Client\Responses\ProductAssemblyRecipeItemLogic4ResponseList;
use Webparking\Logic4Client\Responses\ProductBarcodeLogic4ResponseList;
use Webparking\Logic4Client\Responses\ProductCodeWithSupplierCodeLogic4ResponseList;
use Webparking\Logic4Client\Responses\ProductCompositionItemLogic4ResponseList;
use Webparking\Logic4Client\Responses\ProductDimensionsLogic4Response;
use Webparking\Logic4Client\Responses\ProductExtraBarcodeTypeLogic4ResponseList;
use Webparking\Logic4Client\Responses\ProductImageV2Logic4ResponseList;
use Webparking\Logic4Client\Responses\ProductPickLocationBasedOnSystemSettingsLogic4ResponseList;
use Webparking\Logic4Client\Responses\ProductPriceInformationLogic4Response;
use Webparking\Logic4Client\Responses\ProductReviewLogic4ResponseList;
use Webparking\Logic4Client\Responses\ProductShippingInformationLogic4Response;
use Webparking\Logic4Client\Responses\ProductStatusLogic4ResponseList;
use Webparking\Logic4Client\Responses\ProductSupplierLogic4ResponseList;
use Webparking\Logic4Client\Responses\ProductUnitLogic4ResponseList;
use Webparking\Logic4Client\Responses\ProductWithRelatedProductsLogic4ResponseList;

class Product extends Request
{
    /**
     * @param array{
     *     ProductCode?: string,
     *     ProductDescription1?: string,
     *     ProductDescription2?: string,
     *     BrandId?: integer,
     *     ProductGroup1?: integer,
     *     ProductGroup2?: integer,
     *     ProductGroup3?: integer,
     *     ProductGroup4?: integer,
     *     UnitId?: integer,
     *     Suppliers?: array<mixed>,
     *     Barcode1?: string,
     *     Barcode2?: string,
     *     ExtraBarcodes?: array<mixed>,
     *     VendorCode?: string,
     *     StatusId?: integer,
     *     VisibleOnWebshopFrom?: string,
     *     ExpirationDateOnWebshop?: string,
     *     WarrantyMonths?: integer,
     *     SortId?: integer,
     *     InternalNote?: string,
     *     ProductInfo?: string,
     *     Tags?: string,
     *     USPDescription?: string,
     *     MetaDescription?: string,
     *     SellPriceAdviceEx?: number,
     *     FreeValue1?: string,
     *     FreeValue2?: string,
     *     FreeValue3?: string,
     *     FreeValue4?: string,
     *     FreeValue5?: string,
     *     ProductPrices?: array<mixed>,
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
     *     MinStockCount?: integer,
     *     MaxStockCount?: integer,
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
     *     ImageBase64String?: string,
     *     ProductId?: integer,
     *     ImageName?: string,
     *     ImageId?: integer,
     *     SortId?: integer,
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
     * Verkrijg barcodes met aantallen o.b.v. een filter met artikel Id's.
     *
     * @throws Logic4ApiException
     */
    public function getBarcodesForProductIds(): ProductBarcodeLogic4ResponseList
    {
        return ProductBarcodeLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.1/Products/GetBarcodesForProductIds'),
            )
        );
    }

    /**
     * @throws Logic4ApiException
     */
    public function getBarcodeTypes(): ProductExtraBarcodeTypeLogic4ResponseList
    {
        return ProductExtraBarcodeTypeLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1.1/Products/GetBarcodeTypes'),
            )
        );
    }

    /**
     * Verkrijg basisinformatie van artikelen op basis van artikel Id's.
     *
     * @throws Logic4ApiException
     */
    public function getBasicProductDataForProducts(
    ): BasicProductDataLogic4ResponseList {
        return BasicProductDataLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.1/Products/GetBasicProductDataForProducts'),
            )
        );
    }

    /**
     * Haal merken op o.b.v. het filter.
     *
     * @param array{
     *     SkipRecords?: integer,
     *     TakeRecords?: integer,
     * } $parameters
     *
     * @return PaginatedResponse<Brand>
     *
     * @throws Logic4ApiException
     */
    public function getBrands(array $parameters = []): PaginatedResponse
    {
        return new PaginatedResponse(
            $this->paginateRecords('/v1.2/Products/GetBrands', $parameters),
            Brand::class,
        );
    }

    /**
     * Verkrijg de inhoud van een samengesteld artikel.
     *
     * @throws Logic4ApiException
     */
    public function getComposedProductComposition(
    ): ProductCompositionItemLogic4ResponseList {
        return ProductCompositionItemLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.1/Products/GetComposedProductComposition'),
            )
        );
    }

    /**
     * Verkrijg actuele prijzen voor een specifieke debiteur.
     *
     * @param array{
     *     ProductCode?: string,
     *     DebtorId?: integer,
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
     * Verkrijg een standaard assemblagerecept voor een artikel.
     *
     * @throws Logic4ApiException
     */
    public function getProductAssemblyRecipe(
    ): ProductAssemblyRecipeItemLogic4ResponseList {
        return ProductAssemblyRecipeItemLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.1/Products/GetProductAssemblyRecipe'),
            )
        );
    }

    /**
     * Verkrijg productcodes o.b.v. leverancier productcodes (maximaal 10000).
     *
     * @param array{
     *     SupplierId?: integer,
     *     SupplierCodes?: array<string>,
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
     *     ProductId?: integer,
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
     * @param array{
     *     ProductIds?: array<integer>,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getProductImages(
        array $parameters = [],
    ): ProductImageV2Logic4ResponseList {
        return ProductImageV2Logic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v2/Products/GetProductImages', ['json' => $parameters]),
            )
        );
    }

    /**
     * Haal ID's op van voorraadlocaties voor een bepaald product in een bepaald magazijn.
     *
     * @param array{
     *     ProductIds?: array<integer>,
     *     WarehouseId?: integer,
     *     SystemDefaultPickLocation?: boolean,
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
     *     WebsiteDomainId?: integer,
     *     DateTimeCreatedFrom?: string,
     *     DateTimeCreatedTo?: string,
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
     *     DateTimeChangedFrom?: string,
     *     DateTimeChangedTo?: string,
     *     IsVisibleInLogic4?: boolean,
     *     IsVisibleOnWebShop?: boolean,
     *     AllShowOnWebsite?: boolean,
     *     ProductGroupId?: integer,
     *     UseChildProductGroups?: boolean,
     *     ProductCode?: string,
     *     Barcode?: string,
     *     Barcodes?: array<string>,
     *     DebtorId?: integer,
     *     WebshopUserId?: integer,
     *     WebshopPriceListId?: integer,
     *     UseDropShipmentAmountsForWebshopPrices?: boolean,
     *     ProductIds?: array<integer>,
     *     ProductFilterListChoice?: string,
     *     ProductHistoryBasedOnInvoices?: boolean,
     *     WebshopUserOrderlistProductType?: integer,
     *     ActiveOffers?: boolean,
     *     OfferGroupId?: integer,
     *     FastSearchText?: string,
     *     GetHighestShiftPrice?: boolean,
     *     CountryIdForSellPrice?: integer,
     *     BranchIdForSellPrice?: integer,
     *     LoadExternalStockActiveSupplier?: boolean,
     *     SkipRecords?: integer,
     *     TakeRecords?: integer,
     *     LoadProductGroups?: boolean,
     *     LoadExtraBarcodes?: boolean,
     *     OnlyShowParentProducts?: boolean,
     *     GlobalisationId?: integer,
     *     WebsiteDomainId?: integer,
     *     WareHouseId?: integer,
     *     UseECommerceProductGroups?: boolean,
     *     UseECommerceProductGroupsToLoadProductGroups?: boolean,
     *     LoadStockForWarehouses?: boolean,
     *     LoadAllWebshopGroupsLinkedToProduct?: boolean,
     *     LoadProductTypes?: boolean,
     * } $parameters
     *
     * @return PaginatedResponse<\Webparking\Logic4Client\Data\Product>
     *
     * @throws Logic4ApiException
     */
    public function getProducts(array $parameters = []): PaginatedResponse
    {
        return new PaginatedResponse(
            $this->paginateRecords('/v1.1/Products/GetProducts', $parameters),
            \Webparking\Logic4Client\Data\Product::class,
        );
    }

    /**
     * Verkrijg de verzendinformatie van een product.
     *
     * @param array{
     *     ProductId?: integer,
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
     *     IsVisibleInLogic4?: boolean,
     *     IsVisibleOnWebShop?: boolean,
     *     AllShowOnWebsite?: boolean,
     *     ProductGroupId?: integer,
     *     UseChildProductGroups?: boolean,
     *     ProductCode?: string,
     *     Barcode?: string,
     *     Barcodes?: array<string>,
     *     DebtorId?: integer,
     *     WebshopUserId?: integer,
     *     WebshopPriceListId?: integer,
     *     UseDropShipmentAmountsForWebshopPrices?: boolean,
     *     ProductIds?: array<integer>,
     *     ProductFilterListChoice?: string,
     *     ProductHistoryBasedOnInvoices?: boolean,
     *     WebshopUserOrderlistProductType?: integer,
     *     ActiveOffers?: boolean,
     *     OfferGroupId?: integer,
     *     FastSearchText?: string,
     *     GetHighestShiftPrice?: boolean,
     *     CountryIdForSellPrice?: integer,
     *     BranchIdForSellPrice?: integer,
     *     LoadExternalStockActiveSupplier?: boolean,
     *     SkipRecords?: integer,
     *     TakeRecords?: integer,
     *     LoadProductGroups?: boolean,
     *     LoadExtraBarcodes?: boolean,
     *     OnlyShowParentProducts?: boolean,
     *     GlobalisationId?: integer,
     *     WebsiteDomainId?: integer,
     *     WareHouseId?: integer,
     *     UseECommerceProductGroups?: boolean,
     *     UseECommerceProductGroupsToLoadProductGroups?: boolean,
     *     LoadStockForWarehouses?: boolean,
     *     LoadAllWebshopGroupsLinkedToProduct?: boolean,
     *     LoadProductTypes?: boolean,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getProductsIds(array $parameters = []): Int32Logic4ResponseList
    {
        return Int32Logic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.1/Products/GetProductsIds', ['json' => $parameters]),
            )
        );
    }

    /**
     * @param array{
     *     SkipRecords?: integer,
     *     TakeRecords?: integer,
     *     ProductIds?: array<integer>,
     *     WebsiteDomainId?: integer,
     *     GlobalizationId?: integer,
     *     ProductId?: integer,
     * } $parameters
     *
     * @return PaginatedResponse<ProductSEOInformation>
     *
     * @throws Logic4ApiException
     */
    public function getProductsSEOInformation(array $parameters = []): PaginatedResponse
    {
        return new PaginatedResponse(
            $this->paginateRecords('/v2/Products/GetProductsSEOInformation', $parameters),
            ProductSEOInformation::class,
        );
    }

    /**
     * @param array{
     *     ProductIds?: array<integer>,
     *     RelatedTypeId?: integer,
     *     Skip?: integer,
     *     Take?: integer,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getRelatedProducts(
        array $parameters = [],
    ): ProductWithRelatedProductsLogic4ResponseList {
        return ProductWithRelatedProductsLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.1/Products/GetRelatedProducts', ['json' => $parameters]),
            )
        );
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
    public function getSuppliersForProduct(): ProductSupplierLogic4ResponseList
    {
        return ProductSupplierLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.1/Products/GetSuppliersForProduct'),
            )
        );
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
     * Voor deze aanroep zijn extra rechten vereist.
     *
     * @param array{
     *     SupplierId?: integer,
     *     ProductId?: integer,
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
     *     ProductId?: integer,
     *     ProductDescription1?: string,
     *     ProductDescription2?: string,
     *     ProductGroup2?: integer,
     *     ProductGroup3?: integer,
     *     ProductGroup4?: integer,
     *     UnitId?: integer,
     *     Barcode1?: string,
     *     Barcode2?: string,
     *     VendorCode?: string,
     *     StatusId?: integer,
     *     VisibleOnWebshopFrom?: string,
     *     ExpirationDateOnWebshop?: string,
     *     WarrantyMonths?: integer,
     *     SortId?: integer,
     *     InternalNote?: string,
     *     ProductInfo?: string,
     *     Tags?: string,
     *     USPDescription?: string,
     *     MetaDescription?: string,
     *     SellPriceAdviceEx?: number,
     *     FreeValue1?: string,
     *     FreeValue2?: string,
     *     FreeValue3?: string,
     *     FreeValue4?: string,
     *     FreeValue5?: string,
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
     *     MinStockCount?: integer,
     *     MaxStockCount?: integer,
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
     *     ProductId?: integer,
     *     TypeId?: integer,
     *     Barcode?: string,
     *     Quantity?: integer,
     *     UnitId?: integer,
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
     *     ImageBase64String?: string,
     *     ProductId?: integer,
     *     ImageName?: string,
     *     ImageId?: integer,
     *     SortId?: integer,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function updateProductImage(array $parameters = []): Int32Logic4Response
    {
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
     *     ProductGroup1Id?: integer,
     *     BrandId?: integer,
     *     ProductId?: integer,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function updateProductMainGroupAndBrand(
        array $parameters = [],
    ): Logic4Response {
        return Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->patch('/v1.1/Products/UpdateProductMainGroupAndBrand', ['json' => $parameters]),
            )
        );
    }

    /**
     * Voor deze aanroep zijn extra rechten vereist.
     *
     * @param array{
     *     ProductPrices?: array<mixed>,
     *     ProductId?: integer,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function updateProductPrices(array $parameters = []): Int32Logic4Response
    {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.1/Products/UpdateProductPrices', ['json' => $parameters]),
            )
        );
    }

    /**
     * @param array{
     *     ProductId?: integer,
     *     Barcode?: string,
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
     * @param array{
     *     Supplier_ProductCode?: string,
     *     ProductName?: string,
     *     ProductCountIncrement?: integer,
     *     ShippingTime?: integer,
     *     MinOrderQuantity?: integer,
     *     RepackagingQty?: integer,
     *     RepackagingUnitId?: integer,
     *     InternalNote?: string,
     *     SupplierId?: integer,
     *     ProductId?: integer,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function updateProductSupplier(array $parameters = []): Int32Logic4Response
    {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.1/Products/UpdateProductSupplier', ['json' => $parameters]),
            )
        );
    }

    /**
     * @param array{
     *     ProductId?: integer,
     *     SupplierId?: integer,
     *     ProductPrices?: array<mixed>,
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
