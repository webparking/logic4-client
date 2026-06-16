<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V30;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V30\BasicProductData;
use Webparking\Logic4Client\Responses\V30\Brand;
use Webparking\Logic4Client\Responses\V30\PackingMaterialDepositType;
use Webparking\Logic4Client\Responses\V30\ProductAssemblyRecipeItem;
use Webparking\Logic4Client\Responses\V30\ProductBarcode;
use Webparking\Logic4Client\Responses\V30\ProductCodeWithSupplierCode;
use Webparking\Logic4Client\Responses\V30\ProductCompositionItem;
use Webparking\Logic4Client\Responses\V30\ProductDimensions;
use Webparking\Logic4Client\Responses\V30\ProductExtraBarcodeType;
use Webparking\Logic4Client\Responses\V30\ProductImageV2;
use Webparking\Logic4Client\Responses\V30\ProductMediaFileDto;
use Webparking\Logic4Client\Responses\V30\ProductPickLocationBasedOnSystemSettings;
use Webparking\Logic4Client\Responses\V30\ProductPriceInformation;
use Webparking\Logic4Client\Responses\V30\ProductReview;
use Webparking\Logic4Client\Responses\V30\ProductSEOInformation;
use Webparking\Logic4Client\Responses\V30\ProductShippingInformation;
use Webparking\Logic4Client\Responses\V30\ProductStatus;
use Webparking\Logic4Client\Responses\V30\ProductSupplier;
use Webparking\Logic4Client\Responses\V30\ProductUnit;
use Webparking\Logic4Client\Responses\V30\ProductV14;
use Webparking\Logic4Client\Responses\V30\ProductVariantBalk;
use Webparking\Logic4Client\Responses\V30\ProductVariantBalkChildrenGroup;
use Webparking\Logic4Client\Responses\V30\ProductWithRelatedProductsV3;
use Webparking\Logic4Client\Responses\V30\VariantBalkCategory;
use Webparking\Logic4Client\Responses\V30\WebsiteDomainsForProduct;

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
    public function addProduct(array $parameters = []): int
    {
        return $this->buildResponse(
            $this->getClient()->post('/v3/Products/AddProduct', ['json' => $parameters]),
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
    public function addProductImage(array $parameters = []): int
    {
        return $this->buildResponse(
            $this->getClient()->post('/v3/Products/AddProductImage', ['json' => $parameters]),
        );
    }

    /**
     * Koppel gerelateerde artikelen aan artikelen.
     * Als een product al gekoppeld is en opnieuw wordt gekoppeld, worden de vrije velden overschreven.
     * Wanneer deze vrije velden niet worden meegegeven in een nieuw request, worden de bestaande waarden verwijderd.
     *
     * @param array<array{
     *     ProductId?: int,
     *     RelatedProductId?: int,
     *     RelatedTypeId?: int,
     *     FreeValue1?: string|null,
     *     FreeValue2?: string|null,
     * }> $parameters
     *
     * @throws Logic4ApiException
     */
    public function addRelatedProducts(array $parameters = []): void
    {
        $this->getClient()->post('/v3/Products/AddRelatedProducts', ['json' => $parameters]);
    }

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
    public function addWebsiteDomainForProducts(array $parameters = []): void
    {
        $this->getClient()->post('/v3/Products/AddWebsiteDomainForProducts', ['json' => $parameters]);
    }

    /** @throws Logic4ApiException */
    public function deleteProductImage(int $productid, int $imageid): void
    {
        $this->getClient()->delete('/v3/Products/DeleteProductImage', ['query' => ['productid' => $productid, 'imageid' => $imageid]]);
    }

    /**
     * Ontkoppel gerelateerde artikelen.
     * Ontkoppelt een specifiek gerelateerd artikel. Geef hierbij het RelatedTypeId op om aan te geven welk type koppeling verwijderd moet worden,
     * aangezien een artikel zowel als ‘Gerelateerd’ als ‘Accessoire’ gekoppeld kan zijn.
     * Wanneer RelatedTypeId niet wordt meegegeven in het request, worden alle koppelingen(ongeacht het type) voor het betreffende gerelateerde artikel ontkoppeld.
     *
     * @param array<array{
     *     ProductId?: int,
     *     RelatedProductId?: int,
     *     RelatedTypeId?: int|null,
     * }> $parameters
     *
     * @throws Logic4ApiException
     */
    public function deleteRelatedProducts(array $parameters = []): void
    {
        $this->getClient()->delete('/v3/Products/DeleteRelatedProducts', ['json' => $parameters]);
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
    public function deleteWebsiteDomainForProducts(array $parameters = []): void
    {
        $this->getClient()->delete('/v3/Products/DeleteWebsiteDomainForProducts', ['json' => $parameters]);
    }

    /**
     * Verkrijg barcodes met aantallen o.b.v. een filter met artikel Id's.
     *
     * @param array<int> $parameters
     *
     * @return array<array-key, ProductBarcode>
     *
     * @throws Logic4ApiException
     */
    public function getBarcodesForProductIds(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => ProductBarcode::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Products/GetBarcodesForProductIds', ['json' => $parameters]),
            ),
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
                $this->getClient()->get('/v3/Products/GetBarcodeTypes'),
            ),
        );
    }

    /**
     * Verkrijg basisinformatie van artikelen op basis van artikel Id's.
     *
     * @param array<int> $parameters
     *
     * @return array<array-key, BasicProductData>
     *
     * @throws Logic4ApiException
     */
    public function getBasicProductDataForProducts(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => BasicProductData::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Products/GetBasicProductDataForProducts', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Haal merken op o.b.v. het filter.
     *
     * @param array{
     *     SkipRecords?: int,
     *     TakeRecords?: int,
     * } $parameters
     *
     * @return array<array-key, Brand>
     *
     * @throws Logic4ApiException
     */
    public function getBrands(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => Brand::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Products/GetBrands', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Verkrijg de inhoud van een samengesteld artikel.
     *
     * @return array<array-key, ProductCompositionItem>
     *
     * @throws Logic4ApiException
     */
    public function getComposedProductComposition(int $value): array
    {
        return array_map(
            static fn (array $data) => ProductCompositionItem::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Products/GetComposedProductComposition', ['json' => $value]),
            ),
        );
    }

    /**
     * Haal emballagetypen op.
     *
     * @return array<array-key, PackingMaterialDepositType>
     *
     * @throws Logic4ApiException
     */
    public function getPackageMaterialDepositTypes(): array
    {
        return array_map(
            static fn (array $data) => PackingMaterialDepositType::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/Products/GetPackageMaterialDepositTypes'),
            ),
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
    ): ProductPriceInformation {
        return ProductPriceInformation::make(
            $this->buildResponse(
                $this->getClient()->post('/v3/Products/GetPriceInformationForProduct', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg een standaard assemblagerecept voor een artikel.
     *
     * @return array<array-key, ProductAssemblyRecipeItem>
     *
     * @throws Logic4ApiException
     */
    public function getProductAssemblyRecipe(int $value): array
    {
        return array_map(
            static fn (array $data) => ProductAssemblyRecipeItem::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Products/GetProductAssemblyRecipe', ['json' => $value]),
            ),
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
     * @return array<array-key, ProductCodeWithSupplierCode>
     *
     * @throws Logic4ApiException
     */
    public function getProductCodesBySupplierProductCodes(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => ProductCodeWithSupplierCode::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Products/GetProductCodesBySupplierProductCodes', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Verkrijg de afmetingen van meerdere artikelen.
     *
     * @param array{
     *     ProductIds?: array<int>,
     * } $parameters
     *
     * @return array<array-key, ProductDimensions>
     *
     * @throws Logic4ApiException
     */
    public function getProductDimensions(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => ProductDimensions::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Products/GetProductDimensions', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Ontvang de afbeeldingsinformatie van maximaal 1000 artikelen.
     *
     * @param array{
     *     ProductIds?: array<int>,
     * } $parameters
     *
     * @return array<array-key, ProductImageV2>
     *
     * @throws Logic4ApiException
     */
    public function getProductImages(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => ProductImageV2::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Products/GetProductImages', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Verkrijg product afbeeldingen, videos en documenten.
     *
     * @param array{
     *     ProductIds?: array<int>,
     * } $parameters
     *
     * @return array<array-key, ProductMediaFileDto>
     *
     * @throws Logic4ApiException
     */
    public function getProductMedia(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => ProductMediaFileDto::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Products/GetProductMedia', ['json' => $parameters]),
            ),
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
     * @return array<array-key, ProductPickLocationBasedOnSystemSettings>
     *
     * @throws Logic4ApiException
     */
    public function getProductPickStockLocationIds(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => ProductPickLocationBasedOnSystemSettings::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Products/GetProductPickStockLocationIds', ['json' => $parameters]),
            ),
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
     * @return array<array-key, ProductReview>
     *
     * @throws Logic4ApiException
     */
    public function getProductReviews(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => ProductReview::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Products/GetProductReviews', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Verkrijg artikelen o.b.v. het meegestuurde filter. Het aantal op te vragen artikelen is gelimiteerd tot 10000.
     * <br />
     * Vanaf v1.4 is de werking van <b>BuyPrice</b> gewijzigd. Dit veld bevat nu de inkoopprijs exclusief toeslagen.
     * In voorgaande versies was dit veld inclusief toeslagen. Deze waarde is nu verplaatst naar het nieuwe veld <b>CostPrice</b>.
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
     * @return array<array-key, ProductV14>
     *
     * @throws Logic4ApiException
     */
    public function getProducts(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => ProductV14::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Products/GetProducts', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Verkrijg SEO informatie voor 1 of meerdere artikelen (maximaal 1.000).
     *
     * @param array{
     *     SkipRecords?: int,
     *     TakeRecords?: int,
     *     ProductIds?: array<int>,
     *     WebsiteDomainId?: int|null,
     *     GlobalizationId?: int|null,
     *     ProductId?: int|null,
     * } $parameters
     *
     * @return array<array-key, ProductSEOInformation>
     *
     * @throws Logic4ApiException
     */
    public function getProductsSEOInformation(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => ProductSEOInformation::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Products/GetProductsSEOInformation', ['json' => $parameters]),
            ),
        );
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
    ): ProductShippingInformation {
        return ProductShippingInformation::make(
            $this->buildResponse(
                $this->getClient()->post('/v3/Products/GetProductShippingInformation', ['json' => $parameters]),
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
     * @return array<array-key, int>
     *
     * @throws Logic4ApiException
     */
    public function getProductsIds(array $parameters = []): array
    {
        return $this->buildResponse(
            $this->getClient()->post('/v3/Products/GetProductsIds', ['json' => $parameters]),
        );
    }

    /**
     * @param array{
     *     ProductIds?: array<int>,
     *     Skip?: int|null,
     *     Take?: int|null,
     * } $parameters
     *
     * @return array<array-key, ProductVariantBalkChildrenGroup>
     *
     * @throws Logic4ApiException
     */
    public function getProductVariantBalkChildren(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => ProductVariantBalkChildrenGroup::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Products/GetProductVariantBalkChildren', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Haal gerelateerde artikelen op.
     *
     * @param array{
     *     ProductIds?: array<int>,
     *     RelatedProductIds?: array<int>,
     *     RelatedTypeId?: int|null,
     *     Skip?: int|null,
     *     Take?: int|null,
     * } $parameters
     *
     * @return array<array-key, ProductWithRelatedProductsV3>
     *
     * @throws Logic4ApiException
     */
    public function getRelatedProducts(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => ProductWithRelatedProductsV3::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Products/GetRelatedProducts', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Verkrijg alle productstatussen.
     *
     * @return array<array-key, ProductStatus>
     *
     * @throws Logic4ApiException
     */
    public function getStatuses(): array
    {
        return array_map(
            static fn (array $data) => ProductStatus::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/Products/GetStatuses'),
            ),
        );
    }

    /**
     * Verkrijg alle leveranciers van één product.
     *
     * @return array<array-key, ProductSupplier>
     *
     * @throws Logic4ApiException
     */
    public function getSuppliersForProduct(int $value): array
    {
        return array_map(
            static fn (array $data) => ProductSupplier::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Products/GetSuppliersForProduct', ['json' => $value]),
            ),
        );
    }

    /**
     * Verkrijg alle leveranciers van één of meerdere producten op basis van ProductId's (max. 1000). Of gebruik 'TakeRecords' (max. 10.000).
     * Vanaf v1.2 worden velden met de waarde null niet teruggegeven.
     *
     * @param array{
     *     ProductIds?: array<int>,
     *     SkipRecords?: int,
     *     TakeRecords?: int,
     * } $parameters
     *
     * @return array<array-key, ProductSupplier>
     *
     * @throws Logic4ApiException
     */
    public function getSuppliersForProducts(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => ProductSupplier::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Products/GetSuppliersForProducts', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Verkrijg alle eenheden.
     *
     * @return array<array-key, ProductUnit>
     *
     * @throws Logic4ApiException
     */
    public function getUnits(): array
    {
        return array_map(
            static fn (array $data) => ProductUnit::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/Products/GetUnits'),
            ),
        );
    }

    /**
     * Haal artikel variantbalk categorie gegevens op, waaronder de mogelijke waarden en vertalingen.
     *
     * @param array{
     *     VariantBalkCategoryIds?: array<int>,
     * } $parameters
     *
     * @return array<array-key, VariantBalkCategory>
     *
     * @throws Logic4ApiException
     */
    public function getVariantbalkCategories(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => VariantBalkCategory::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Products/GetVariantbalkCategories', ['json' => $parameters]),
            ),
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
     * @return array<array-key, ProductVariantBalk>
     *
     * @throws Logic4ApiException
     */
    public function getVariantbalks(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => ProductVariantBalk::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Products/GetVariantbalks', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Het ophalen van gekoppelde webshops per product, max. 1000 producten per request.
     *
     * @param array{
     *     ProductIds?: array<int>,
     * } $parameters
     *
     * @return array<array-key, WebsiteDomainsForProduct>
     *
     * @throws Logic4ApiException
     */
    public function getWebsiteDomainsForProducts(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => WebsiteDomainsForProduct::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Products/GetWebsiteDomainsForProducts', ['json' => $parameters]),
            ),
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
    public function removeProductSupplier(array $parameters = []): void
    {
        $this->getClient()->delete('/v3/Products/RemoveProductSupplier', ['json' => $parameters]);
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
    public function setActiveProductSupplier(array $parameters = []): void
    {
        $this->getClient()->post('/v3/Products/SetActiveProductSupplier', ['json' => $parameters]);
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
    public function updateProduct(array $parameters = []): void
    {
        $this->getClient()->patch('/v3/Products/UpdateProduct', ['json' => $parameters]);
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
    public function updateProductAddExtraBarcode(array $parameters = []): void
    {
        $this->getClient()->post('/v3/Products/UpdateProductAddExtraBarcode', ['json' => $parameters]);
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
    public function updateProductImage(array $parameters = []): void
    {
        $this->getClient()->put('/v3/Products/UpdateProductImage', ['json' => $parameters]);
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
    public function updateProductMainGroupAndBrand(array $parameters = []): void
    {
        $this->getClient()->patch('/v3/Products/UpdateProductMainGroupAndBrand', ['json' => $parameters]);
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
    public function updateProductPrices(array $parameters = []): void
    {
        $this->getClient()->post('/v3/Products/UpdateProductPrices', ['json' => $parameters]);
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
    public function updateProductRemoveExtraBarcode(array $parameters = []): void
    {
        $this->getClient()->post('/v3/Products/UpdateProductRemoveExtraBarcode', ['json' => $parameters]);
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
    public function updateProductSEOInformation(array $parameters = []): void
    {
        $this->getClient()->patch('/v3/Products/UpdateProductSEOInformation', ['json' => $parameters]);
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
    public function updateProductSupplier(array $parameters = []): void
    {
        $this->getClient()->post('/v3/Products/UpdateProductSupplier', ['json' => $parameters]);
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
    public function updateProductSupplierProductPrice(array $parameters = []): void
    {
        $this->getClient()->post('/v3/Products/UpdateProductSupplierProductPrice', ['json' => $parameters]);
    }
}
