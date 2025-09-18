<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V10;

use Webparking\Logic4Client\Data\V10\ProductStockSupplierWithActive;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V10\BooleanLogic4Response;
use Webparking\Logic4Client\Responses\V10\Int32Logic4Response;
use Webparking\Logic4Client\Responses\V10\ProductMinimalStockNumberLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\ProductStockControlHeadLogic4Response;
use Webparking\Logic4Client\Responses\V10\ProductStockControlHeadLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\ProductStockControlRowLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\ProductStockInformationLogic4Response;
use Webparking\Logic4Client\Responses\V10\ProductStockLocationsLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\ProductStockLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\ProductStockMutationLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\ProductStockMutationTypeLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\ProductStockSuppliersLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\ProductStockWarehouseWithDefaultPickLocationLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\ProductSupplierNextDeliveryLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\StockLocationForProductLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\WareHouseLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\WarehouseStockLocationLogic4ResponseList;

class StockRequest extends Request
{
    /**
     * Maak een voorraadmutatie aan.
     *
     * @param array{
     *     TypeId?: int|null,
     *     LedgerId?: int|null,
     *     ProductId?: int|null,
     *     Amount?: number|null,
     *     Remarks?: string|null,
     *     StockLocationId?: int|null,
     *     StockMutationTypeId?: int|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     *
     * @deprecated Let op! Versie 1.0 is verouderd. Gebruik versie v2.0. - Voorraadmutatie aanmaken
     */
    public function createProductStockMutation(
        array $parameters = [],
    ): Int32Logic4Response {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Stock/CreateProductStockMutation', ['json' => $parameters]),
            )
        );
    }

    /**
     * Alleen wanneer in een magazijn een reserveerlocatie is gedefinieerd kunnen tot maximaal 100 mutaties worden uitgevoerd.
     *
     * @param array<array{
     *     PickbonId?: int|null,
     *     OrderRowId?: int|null,
     *     Amount?: number|null,
     *     Timestamp?: string|null,
     *     Remarks?: string|null,
     *     StockLocationId?: int|null,
     *     StockMutationTypeId?: int|null,
     * }> $parameters
     *
     * @throws Logic4ApiException
     */
    public function createProductStockMutationToReservationLocation(
        array $parameters = [],
    ): Int32Logic4Response {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Stock/CreateProductStockMutationToReservationLocation', ['json' => $parameters]),
            )
        );
    }

    /**
     * Ophalen van externe voorraadstanden voor actieve leveranciers.
     *
     * @param array{
     *     ProductStockFrom?: int|null,
     *     DateTimeLastUpdateSince?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     *
     * @deprecated Let op! Versie 1.0 is verouderd. Gebruik versie v1.1. - Externe voorraadstanden actieve leveranciers
     */
    public function getExternalStockForActiveSuppliers(
        array $parameters = [],
    ): ProductStockSuppliersLogic4ResponseList {
        return ProductStockSuppliersLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Stock/GetExternalStockForActiveSuppliers', ['json' => $parameters]),
            )
        );
    }

    /**
     * Ophalen van externe voorraadstanden voor actieve en niet-actieve leveranciers.
     *
     * @param array{
     *     SupplierId?: int|null,
     *     Active?: bool|null,
     *     ProductIds?: array<int>|null,
     *     SkipRecords?: int|null,
     *     TakeRecords?: int|null,
     * } $parameters
     *
     * @return \Generator<array-key, ProductStockSupplierWithActive>
     *
     * @throws Logic4ApiException
     */
    public function getExternalStockForSuppliers(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1/Stock/GetExternalStockForSuppliers', $parameters);

        foreach ($iterator as $record) {
            yield ProductStockSupplierWithActive::make($record);
        }
    }

    /**
     * Verkrijg minimale voorraad aantallen voor meerdere artikelen.
     *
     * @param array<int> $parameters
     *
     * @throws Logic4ApiException
     */
    public function getMinimalStockNumbersForProducts(
        array $parameters = [],
    ): ProductMinimalStockNumberLogic4ResponseList {
        return ProductMinimalStockNumberLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Stock/GetMinimalStockNumbersForProducts', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg de eerst volgende leverdata van alle actieve leveranciers, vanaf een specifieke datum.
     *
     * @throws Logic4ApiException
     *
     * @deprecated Let op! Versie 1.0 is verouderd. Gebruik versie v1.1. - Eerst volgende leverdata van actieve leveranciers
     */
    public function getNextDeliveriesDatesForActiveSuppliers(
        mixed $value,
    ): ProductSupplierNextDeliveryLogic4ResponseList {
        return ProductSupplierNextDeliveryLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Stock/GetNextDeliveriesDatesForActiveSuppliers', ['json' => $value]),
            )
        );
    }

    /**
     * Verkrijg de huidige voorraadlocaties van het product op basis van het filter.
     *
     * @param array{
     *     ProductsWithWarehouse?: array<array{ProductId?: int, WarehouseId?: int|null, StockLocationId?: int|null}>|null,
     *     ShowNegativeLocations?: bool|null,
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
     * Haal voorraadmutaties op. Maximaal 1 miljoen records per keer kunnen worden opgehaald.
     *
     * @param array{
     *     DateFrom?: string|null,
     *     DateTo?: string|null,
     *     BuyOrderId?: int|null,
     *     StocklocationId?: int|null,
     *     ITSIssueId?: int|null,
     *     ProductCode?: string|null,
     *     WareHouseId?: int|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     *
     * @deprecated Let op! Versie 1.0 is verouderd. Gebruik versie v1.1. - Haal voorraadmutaties op
     */
    public function getProductStockMutations(
        array $parameters = [],
    ): ProductStockMutationLogic4ResponseList {
        return ProductStockMutationLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Stock/GetProductStockMutations', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg voorraadmutatie types.
     *
     * @throws Logic4ApiException
     *
     * @deprecated Let op! Versie 1.0 is verouderd. Gebruik versie v1.1. - Voorraadmutatie types
     */
    public function getProductStockMutationTypes(
    ): ProductStockMutationTypeLogic4ResponseList {
        return ProductStockMutationTypeLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Stock/GetProductStockMutationTypes'),
            )
        );
    }

    /**
     * Haal voor alle magazijnen van een of meer producten de minimale voorraadgrens, maximale voorraadgrens,
     * notitie en standaard picklocatie op.
     *
     * @param array{
     *     ProductIds?: array<int>|null,
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
    public function getStockControlHead(
        int $value,
    ): ProductStockControlHeadLogic4Response {
        return ProductStockControlHeadLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Stock/GetStockControlHead', ['json' => $value]),
            )
        );
    }

    /**
     * Voorraadcontrole heads ophalen op basis van het ProductStockControlHeadFilter.
     *
     * @param array{
     *     StockLocationId?: int|null,
     *     UserId?: int|null,
     *     CreatedDateFrom?: string|null,
     *     CreatedDateTo?: string|null,
     *     IsProcessed?: bool|null,
     *     ProductStockControlHeadId?: int|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     *
     * @deprecated Let op! Versie 1.0 is verouderd. Gebruik versie v1.1. - Voorraadcontrole heads ophalen op basis van het ProductStockControlHeadFilter
     */
    public function getStockControlHeads(
        array $parameters = [],
    ): ProductStockControlHeadLogic4ResponseList {
        return ProductStockControlHeadLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Stock/GetStockControlHeads', ['json' => $parameters]),
            )
        );
    }

    /**
     * Ophalen van voorraadstanden voor specifieke magazijnen.
     *
     * @param array{
     *     WareHouseId?: int|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     *
     * @deprecated Let op! Versie 1.0 is verouderd. Gebruik versie v1.1. - Voorraadstanden ophalen
     */
    public function getStockForWarehouses(
        array $parameters = [],
    ): ProductStockLogic4ResponseList {
        return ProductStockLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Stock/GetStockForWarehouses', ['json' => $parameters]),
            )
        );
    }

    /**
     * Haal actuele voorraad op voor een artikel.
     *
     * @param array{
     *     ProductCode?: string|null,
     *     WareHouseId?: int|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     *
     * @deprecated Let op! Versie 1.0 is verouderd. Gebruik versie v2.0. - Haal actuele voorraad op voor een artikel
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
        int $value,
    ): ProductStockLocationsLogic4ResponseList {
        return ProductStockLocationsLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Stock/GetStockLocationsForProduct', ['json' => $value]),
            )
        );
    }

    /**
     * Haal voorraadlocaties op van meerdere producten.
     *
     * @param array{
     *     ProductIds?: array<int>|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getStockLocationsForProducts(
        array $parameters = [],
    ): ProductStockLocationsLogic4ResponseList {
        return ProductStockLocationsLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Stock/GetStockLocationsForProducts', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg de producten die op de locatie aanwezig zouden moeten zijn.
     *
     * @throws Logic4ApiException
     *
     * @deprecated Let op! Versie 1.0 is verouderd. Gebruik versie v1.1. - Verkrijg de producten die op de locatie aanwezig zouden moeten zijn
     */
    public function getStockProductsForStockLocation(
        int $value,
    ): ProductStockControlRowLogic4ResponseList {
        return ProductStockControlRowLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Stock/GetStockProductsForStockLocation', ['json' => $value]),
            )
        );
    }

    /**
     * Haal alle magazijnen op voor een administratie.
     *
     * @throws Logic4ApiException
     */
    public function getWarehousesForAdministration(
        int $value,
    ): WareHouseLogic4ResponseList {
        return WareHouseLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Stock/GetWarehousesForAdministration', ['json' => $value]),
            )
        );
    }

    /**
     * Haal alle locaties op die bij een administratie behoren.
     *
     * @throws Logic4ApiException
     */
    public function getWarehousesStockLocationsForAdministration(
        int $value,
    ): WarehouseStockLocationLogic4ResponseList {
        return WarehouseStockLocationLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Stock/GetWarehousesStockLocationsForAdministration', ['json' => $value]),
            )
        );
    }

    /**
     * Maak een voorraadverplaatsing aan.
     * Return True wanneer gelukt, anders foutmelding.
     *
     * @param array{
     *     Items?: array<array{ProductId?: int, MutationAmount?: number, OrderHeadPickbonId?: int|null}>|null,
     *     FromStockLocationId?: int|null,
     *     FromWarehouseId?: int|null,
     *     ToStockLocationId?: int|null,
     *     Notes?: string|null,
     *     Name?: string|null,
     *     DatabaseAdministrationId?: int|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     *
     * @deprecated Let op! Versie 1.0 is verouderd. Gebruik versie v1.1. - Maak een voorraadverplaatsing aan
     */
    public function postCreateStockMovement(
        array $parameters = [],
    ): BooleanLogic4Response {
        return BooleanLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Stock/PostCreateStockMovement', ['json' => $parameters]),
            )
        );
    }

    /**
     * Wijzig externe voorraadstand van een leverancier.
     *
     * @param array{
     *     ProductId?: int|null,
     *     ProductCode?: string|null,
     *     SupplierId?: int|null,
     *     Quantity?: int|null,
     *     ProductNextDelivery?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function setExternalStockForSupplier(
        array $parameters = [],
    ): BooleanLogic4Response {
        return BooleanLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Stock/SetExternalStockForSupplier', ['json' => $parameters]),
            )
        );
    }

    /**
     * Voeg eerstvolgende leverdata van leveranciers toe voor één of meer artikelen (max 100 per request).
     *
     * @param array<array{
     *     ProductId?: int|null,
     *     SupplierId?: int|null,
     *     DeliveryDate?: string|null,
     * }> $parameters
     *
     * @throws Logic4ApiException
     */
    public function setNextDeliveriesDatesForActiveSuppliers(
        array $parameters = [],
    ): BooleanLogic4Response {
        return BooleanLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Stock/SetNextDeliveriesDatesForActiveSuppliers', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verander de standaard picklocatie van artikelen naar een andere voorraad locatie.
     *
     * @param array<array{
     *     ProductId?: int|null,
     *     WarehouseStockLocationId?: int|null,
     *     WarehouseId?: int|null,
     * }> $parameters
     *
     * @throws Logic4ApiException
     *
     * @deprecated Let op! Versie 1.0 is verouderd. Gebruik versie v1.1. - Standaard picklocatie aanpassen
     */
    public function updateDefaultPickLocations(
        array $parameters = [],
    ): BooleanLogic4Response {
        return BooleanLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Stock/UpdateDefaultPickLocations', ['json' => $parameters]),
            )
        );
    }

    /**
     * Voeg een nieuwe voorraadcontrole toe of update de meegegeven head met de bijbehorende rijen als het Id van _head is meegegeven.
     *
     * @param array{
     *     CreatedDate?: string|null,
     *     Id?: int|null,
     *     LocationName?: string|null,
     *     LocationId?: int|null,
     *     ProcessDate?: string|null,
     *     Username?: string|null,
     *     UserId?: int|null,
     *     Rows?: array<array{Id?: int|null, ProductStockHeadId?: int|null, ProductId?: int, ProductDescription?: string|null, ProductDescription2?: string|null, Vendorcode?: string|null, StockTotal?: number, StockOnCurrentLocation?: number, StockCountedByUser?: number|null, StockLevelDate?: string, Barcode?: string|null, ProductCode?: string|null, Barcode2?: string|null, SystemBarcode?: string|null, BarcodeExtraList?: array<array{Barcode?: string|null, Qty?: int}>|null}>|null,
     *     EventLog?: string|null,
     *     WarehouseStockControlEmailTemplateId?: int|null,
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
