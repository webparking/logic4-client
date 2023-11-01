<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests;

use Webparking\Logic4Client\Data\ProductStock;
use Webparking\Logic4Client\Data\ProductStockControlHead;
use Webparking\Logic4Client\Data\ProductStockControlRow;
use Webparking\Logic4Client\Data\ProductStockMutation;
use Webparking\Logic4Client\Data\ProductStockSuppliers;
use Webparking\Logic4Client\Data\ProductStockSupplierWithActive;
use Webparking\Logic4Client\Data\ProductSupplierNextDelivery;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\PaginatedResponse;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\BooleanLogic4Response;
use Webparking\Logic4Client\Responses\Int32Logic4Response;
use Webparking\Logic4Client\Responses\ProductMinimalStockNumberLogic4ResponseList;
use Webparking\Logic4Client\Responses\ProductStockControlHeadLogic4Response;
use Webparking\Logic4Client\Responses\ProductStockInformationLogic4Response;
use Webparking\Logic4Client\Responses\ProductStockLocationsLogic4ResponseList;
use Webparking\Logic4Client\Responses\ProductStockMutationTypeV11Logic4ResponseList;
use Webparking\Logic4Client\Responses\ProductStockWarehouseWithDefaultPickLocationLogic4ResponseList;
use Webparking\Logic4Client\Responses\StockLocationForProductLogic4ResponseList;
use Webparking\Logic4Client\Responses\WareHouseLogic4ResponseList;
use Webparking\Logic4Client\Responses\WarehouseStockLocationLogic4ResponseList;

class Stock extends Request
{
    /**
     * Maak een voorraadmutatie aan.
     *
     * @param array{
     *     LedgerId?: integer,
     *     ITS_IssueId?: integer,
     *     ProductId?: integer,
     *     Amount?: number,
     *     Remarks?: string,
     *     StockLocationId?: integer,
     *     StockMutationTypeId?: integer,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function createProductStockMutation(
        array $parameters = [],
    ): Int32Logic4Response {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v2/Stock/CreateProductStockMutation', ['json' => $parameters]),
            )
        );
    }

    /**
     * Alleen wanneer in een magazijn een reserveerlocatie is gedefinieerd kunnen tot maximaal 100 mutaties worden uitgevoerd.
     *
     * @throws Logic4ApiException
     */
    public function createProductStockMutationToReservationLocation(
    ): Int32Logic4Response {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Stock/CreateProductStockMutationToReservationLocation'),
            )
        );
    }

    /**
     * Ophalen van externe voorraadstanden voor actieve leveranciers.
     *
     * @param array{
     *     SkipRecords?: integer,
     *     TakeRecords?: integer,
     *     ProductStockFrom?: integer,
     *     DateTimeLastUpdateSince?: string,
     * } $parameters
     *
     * @return PaginatedResponse<ProductStockSuppliers>
     *
     * @throws Logic4ApiException
     */
    public function getExternalStockForActiveSuppliers(
        array $parameters = [],
    ): PaginatedResponse {
        return new PaginatedResponse(
            $this->paginateRecords('/v1.1/Stock/GetExternalStockForActiveSuppliers', $parameters),
            ProductStockSuppliers::class,
        );
    }

    /**
     * Ophalen van externe voorraadstanden voor actieve en niet-actieve leveranciers.
     *
     * @param array{
     *     SupplierId?: integer,
     *     Active?: boolean,
     *     ProductIds?: array<integer>,
     *     SkipRecords?: integer,
     *     TakeRecords?: integer,
     * } $parameters
     *
     * @return PaginatedResponse<ProductStockSupplierWithActive>
     *
     * @throws Logic4ApiException
     */
    public function getExternalStockForSuppliers(array $parameters = []): PaginatedResponse
    {
        return new PaginatedResponse(
            $this->paginateRecords('/v1/Stock/GetExternalStockForSuppliers', $parameters),
            ProductStockSupplierWithActive::class,
        );
    }

    /**
     * Verkrijg minimale voorraad aantallen voor meerdere artikelen.
     *
     * @throws Logic4ApiException
     */
    public function getMinimalStockNumbersForProducts(
    ): ProductMinimalStockNumberLogic4ResponseList {
        return ProductMinimalStockNumberLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Stock/GetMinimalStockNumbersForProducts'),
            )
        );
    }

    /**
     * Verkrijg de eerst volgende leverdata van alle actieve leveranciers, vanaf een specifieke datum.
     *
     * @param array{
     *     NextDeliveryDate?: string,
     *     SkipRecords?: integer,
     *     TakeRecords?: integer,
     * } $parameters
     *
     * @return PaginatedResponse<ProductSupplierNextDelivery>
     *
     * @throws Logic4ApiException
     */
    public function getNextDeliveriesDatesForActiveSuppliers(
        array $parameters = [],
    ): PaginatedResponse {
        return new PaginatedResponse(
            $this->paginateRecords('/v1.1/Stock/GetNextDeliveriesDatesForActiveSuppliers', $parameters),
            ProductSupplierNextDelivery::class,
        );
    }

    /**
     * Verkrijg de huidige voorraadlocaties van het product op basis van het filter.
     *
     * @param array{
     *     ProductsWithWarehouse?: array<mixed>,
     *     ShowNegativeLocations?: boolean,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getProductStockLocationsWithName(
        array $parameters = [],
    ): StockLocationForProductLogic4ResponseList {
        return StockLocationForProductLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Stock/GetProductStockLocationsWithName', ['json' => $parameters]),
            )
        );
    }

    /**
     * Haal voorraadmutaties op. Maximaal 10000 records per keer kunnen worden opgehaald.
     *
     * @param array{
     *     SkipRecords?: integer,
     *     TakeRecords?: integer,
     *     DateFrom?: string,
     *     DateTo?: string,
     *     BuyOrderId?: integer,
     *     StocklocationId?: integer,
     *     ITSIssueId?: integer,
     *     ProductCode?: string,
     *     WareHouseId?: integer,
     * } $parameters
     *
     * @return PaginatedResponse<ProductStockMutation>
     *
     * @throws Logic4ApiException
     */
    public function getProductStockMutations(array $parameters = []): PaginatedResponse
    {
        return new PaginatedResponse(
            $this->paginateRecords('/v1.1/Stock/GetProductStockMutations', $parameters),
            ProductStockMutation::class,
        );
    }

    /**
     * Verkrijg voorraadmutatie types.
     *
     * @throws Logic4ApiException
     */
    public function getProductStockMutationTypes(
    ): ProductStockMutationTypeV11Logic4ResponseList {
        return ProductStockMutationTypeV11Logic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1.1/Stock/GetProductStockMutationTypes'),
            )
        );
    }

    /**
     * Haal voor alle magazijnen van een of meer producten de minimale voorraadgrens, maximale voorraadgrens,
     * notitie en standaard picklocatie op.
     *
     * @param array{
     *     ProductIds?: array<integer>,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getProductStockWarehouseWithDefaultPickLocation(
        array $parameters = [],
    ): ProductStockWarehouseWithDefaultPickLocationLogic4ResponseList {
        return ProductStockWarehouseWithDefaultPickLocationLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Stock/GetProductStockWarehouseWithDefaultPickLocation', ['json' => $parameters]),
            )
        );
    }

    /**
     * Haalt een voorraadcontrole op aan de hand van een Id.
     *
     * @throws Logic4ApiException
     */
    public function getStockControlHead(): ProductStockControlHeadLogic4Response
    {
        return ProductStockControlHeadLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Stock/GetStockControlHead'),
            )
        );
    }

    /**
     * Voorraadcontrole heads ophalen op basis van het ProductStockControlHeadFilter.
     *
     * @param array{
     *     SkipRecords?: integer,
     *     TakeRecords?: integer,
     *     StockLocationId?: integer,
     *     UserId?: integer,
     *     CreatedDateFrom?: string,
     *     CreatedDateTo?: string,
     *     IsProcessed?: boolean,
     *     ProductStockControlHeadId?: integer,
     * } $parameters
     *
     * @return PaginatedResponse<ProductStockControlHead>
     *
     * @throws Logic4ApiException
     */
    public function getStockControlHeads(array $parameters = []): PaginatedResponse
    {
        return new PaginatedResponse(
            $this->paginateRecords('/v1.1/Stock/GetStockControlHeads', $parameters),
            ProductStockControlHead::class,
        );
    }

    /**
     * Ophalen van voorraadstanden voor specifieke magazijnen.
     *
     * @param array{
     *     SkipRecords?: integer,
     *     TakeRecords?: integer,
     *     WareHouseId?: integer,
     * } $parameters
     *
     * @return PaginatedResponse<ProductStock>
     *
     * @throws Logic4ApiException
     */
    public function getStockForWarehouses(array $parameters = []): PaginatedResponse
    {
        return new PaginatedResponse(
            $this->paginateRecords('/v1.1/Stock/GetStockForWarehouses', $parameters),
            ProductStock::class,
        );
    }

    /**
     * Haal actuele voorraad op voor een artikel.
     *
     * @param array{
     *     ProductCode?: string,
     *     WareHouseId?: integer,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getStockInformationForProduct(
        array $parameters = [],
    ): ProductStockInformationLogic4Response {
        return ProductStockInformationLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Stock/GetStockInformationForProduct', ['json' => $parameters]),
            )
        );
    }

    /**
     * Haal voorraadlocaties op van een product.
     *
     * @throws Logic4ApiException
     */
    public function getStockLocationsForProduct(
    ): ProductStockLocationsLogic4ResponseList {
        return ProductStockLocationsLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Stock/GetStockLocationsForProduct'),
            )
        );
    }

    /**
     * Verkrijg de producten die op de locatie aanwezig zouden moeten zijn.
     *
     * @param array{
     *     LocationId?: integer,
     *     SkipRecords?: integer,
     *     TakeRecords?: integer,
     * } $parameters
     *
     * @return PaginatedResponse<ProductStockControlRow>
     *
     * @throws Logic4ApiException
     */
    public function getStockProductsForStockLocation(array $parameters = []): PaginatedResponse
    {
        return new PaginatedResponse(
            $this->paginateRecords('/v1.1/Stock/GetStockProductsForStockLocation', $parameters),
            ProductStockControlRow::class,
        );
    }

    /**
     * Haal alle magazijnen op voor een administratie.
     *
     * @throws Logic4ApiException
     */
    public function getWarehousesForAdministration(): WareHouseLogic4ResponseList
    {
        return WareHouseLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Stock/GetWarehousesForAdministration'),
            )
        );
    }

    /**
     * Haal alle locaties op die bij een administratie behoren.
     *
     * @throws Logic4ApiException
     */
    public function getWarehousesStockLocationsForAdministration(
    ): WarehouseStockLocationLogic4ResponseList {
        return WarehouseStockLocationLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Stock/GetWarehousesStockLocationsForAdministration'),
            )
        );
    }

    /**
     * Maak een voorraadverplaatsing aan.
     * Return True wanneer gelukt, anders foutmelding.
     *
     * @param array{
     *     Items?: array<mixed>,
     *     FromStockLocationId?: integer,
     *     FromWarehouseId?: integer,
     *     ToStockLocationId?: integer,
     *     Notes?: string,
     *     Name?: string,
     *     DatabaseAdministrationId?: integer,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function postCreateStockMovement(
        array $parameters = [],
    ): BooleanLogic4Response {
        return BooleanLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.1/Stock/PostCreateStockMovement', ['json' => $parameters]),
            )
        );
    }

    /**
     * Wijzig externe voorraadstand van een leverancier.
     *
     * @param array{
     *     ProductId?: integer,
     *     ProductCode?: string,
     *     SupplierId?: integer,
     *     Quantity?: integer,
     *     ProductNextDelivery?: string,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function setExternalStockForSupplier(array $parameters = []): bool
    {
        return $this->buildResponse(
            $this->getClient()->post('/v1/Stock/SetExternalStockForSupplier', ['json' => $parameters]),
        );
    }

    /**
     * Voeg eerstvolgende leverdata van leveranciers toe voor één of meer artikelen (max 100 per request).
     *
     * @throws Logic4ApiException
     */
    public function setNextDeliveriesDatesForActiveSuppliers(): BooleanLogic4Response
    {
        return BooleanLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Stock/SetNextDeliveriesDatesForActiveSuppliers'),
            )
        );
    }

    /**
     * Verander de standaard picklocatie van artikelen naar een andere voorraad locatie.
     *
     * @throws Logic4ApiException
     */
    public function updateDefaultPickLocations(): BooleanLogic4Response
    {
        return BooleanLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.1/Stock/UpdateDefaultPickLocations'),
            )
        );
    }

    /**
     * Voeg een nieuwe voorraadcontrole toe of update de meegegeven head met de bijbehorende rijen als het Id van _head is meegegeven.
     *
     * @param array{
     *     CreatedDate?: string,
     *     Id?: integer,
     *     LocationName?: string,
     *     LocationId?: integer,
     *     ProcessDate?: string,
     *     Username?: string,
     *     UserId?: integer,
     *     Rows?: array<mixed>,
     *     EventLog?: string,
     *     WarehouseStockControlEmailTemplateId?: integer,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function updateOrCreateStockControlHeads(
        array $parameters = [],
    ): ProductStockControlHeadLogic4Response {
        return ProductStockControlHeadLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Stock/UpdateOrCreateStockControlHeads', ['json' => $parameters]),
            )
        );
    }
}
