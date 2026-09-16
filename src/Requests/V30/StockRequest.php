<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V30;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V30\ProductMinimalStockNumber;
use Webparking\Logic4Client\Responses\V30\ProductStock;
use Webparking\Logic4Client\Responses\V30\ProductStockControlHead;
use Webparking\Logic4Client\Responses\V30\ProductStockControlRow;
use Webparking\Logic4Client\Responses\V30\ProductStockInformationV2;
use Webparking\Logic4Client\Responses\V30\ProductStockLocations;
use Webparking\Logic4Client\Responses\V30\ProductStockMutation;
use Webparking\Logic4Client\Responses\V30\ProductStockMutationTypeV11;
use Webparking\Logic4Client\Responses\V30\ProductStockSuppliers;
use Webparking\Logic4Client\Responses\V30\ProductStockSupplierWithActive;
use Webparking\Logic4Client\Responses\V30\ProductStockWarehouseWithDefaultPickLocation;
use Webparking\Logic4Client\Responses\V30\ProductSupplierNextDelivery;
use Webparking\Logic4Client\Responses\V30\StockLocationForProduct;
use Webparking\Logic4Client\Responses\V30\WareHouse;
use Webparking\Logic4Client\Responses\V30\WarehouseStockLocation;

class StockRequest extends Request
{
    /**
     * Maak een voorraadmutatie aan.
     *
     * @param array{
     *     LedgerId?: int|null,
     *     ITS_IssueId?: int|null,
     *     ProductId?: int,
     *     Amount?: number,
     *     Remarks?: string|null,
     *     StockLocationId?: int,
     *     StockMutationTypeId?: int,
     * } $parameters
     *
     * @return array<array-key, ProductStockMutationTypeV11>
     *
     * @throws Logic4ApiException
     */
    public function createProductStockMutation(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => ProductStockMutationTypeV11::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Stock/CreateProductStockMutation', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Verplaats artikelen van een normale voorraadlocatie naar de reserveerlocatie.
     * Alleen wanneer in een magazijn een reserveerlocatie is gedefinieerd kunnen tot maximaal 100 mutaties worden uitgevoerd.
     *
     * @param array<array{
     *     PickbonId?: int,
     *     OrderRowId?: int,
     *     Amount?: number,
     *     Timestamp?: string,
     *     Remarks?: string|null,
     *     StockLocationId?: int,
     *     StockMutationTypeId?: int,
     * }> $parameters
     *
     * @throws Logic4ApiException
     */
    public function createProductStockMutationToReservationLocation(array $parameters = []): void
    {
        $this->getClient()->post('/v3/Stock/CreateProductStockMutationToReservationLocation', ['json' => $parameters]);
    }

    /**
     * Ophalen van externe voorraadstanden voor actieve leveranciers.
     *
     * @param array{
     *     SkipRecords?: int,
     *     TakeRecords?: int,
     *     ProductStockFrom?: int|null,
     *     DateTimeLastUpdateSince?: string|null,
     * } $parameters
     *
     * @return array<array-key, ProductStockSuppliers>
     *
     * @throws Logic4ApiException
     */
    public function getExternalStockForActiveSuppliers(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => ProductStockSuppliers::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Stock/GetExternalStockForActiveSuppliers', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Ophalen van externe voorraadstanden voor actieve en niet-actieve leveranciers.
     *
     * @param array{
     *     SupplierId?: int|null,
     *     Active?: bool|null,
     *     ProductIds?: array<int>,
     *     SkipRecords?: int,
     *     TakeRecords?: int,
     * } $parameters
     *
     * @return array<array-key, ProductStockSupplierWithActive>
     *
     * @throws Logic4ApiException
     */
    public function getExternalStockForSuppliers(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => ProductStockSupplierWithActive::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Stock/GetExternalStockForSuppliers', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Verkrijg minimale voorraad aantallen voor meerdere artikelen.
     *
     * @param array<int> $parameters
     *
     * @return array<array-key, ProductMinimalStockNumber>
     *
     * @throws Logic4ApiException
     */
    public function getMinimalStockNumbersForProducts(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => ProductMinimalStockNumber::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Stock/GetMinimalStockNumbersForProducts', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Verkrijg de eerstvolgende leverdata van alle actieve leveranciers, vanaf een specifieke datum.
     *
     * @param array{
     *     NextDeliveryDate?: string,
     *     SkipRecords?: int,
     *     TakeRecords?: int,
     * } $parameters
     *
     * @return array<array-key, ProductSupplierNextDelivery>
     *
     * @throws Logic4ApiException
     */
    public function getNextDeliveriesDatesForActiveSuppliers(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => ProductSupplierNextDelivery::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Stock/GetNextDeliveriesDatesForActiveSuppliers', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Verkrijg de huidige voorraadlocaties van het product op basis van het filter.
     *
     * @param array{
     *     ProductsWithWarehouse?: array<array{ProductId?: int, WarehouseId?: int|null, StockLocationId?: int|null}>,
     *     ShowNegativeLocations?: bool,
     * } $parameters
     *
     * @return array<array-key, StockLocationForProduct>
     *
     * @throws Logic4ApiException
     */
    public function getProductStockLocationsWithName(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => StockLocationForProduct::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Stock/GetProductStockLocationsWithName', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Haal voorraadmutaties op. Maximaal 10.000 records per keer kunnen worden opgehaald.
     *
     * @param array{
     *     SkipRecords?: int,
     *     TakeRecords?: int,
     *     PickbonIds?: array<int>,
     *     DateFrom?: string|null,
     *     DateTo?: string|null,
     *     BuyOrderId?: int|null,
     *     StocklocationId?: int|null,
     *     ITSIssueId?: int|null,
     *     ProductCode?: string|null,
     *     WareHouseId?: int|null,
     * } $parameters
     *
     * @return array<array-key, ProductStockMutation>
     *
     * @throws Logic4ApiException
     */
    public function getProductStockMutations(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => ProductStockMutation::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Stock/GetProductStockMutations', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Verkrijg voorraadmutatie types.
     *
     * @return array<array-key, ProductStockMutationTypeV11>
     *
     * @throws Logic4ApiException
     */
    public function getProductStockMutationTypes(): array
    {
        return array_map(
            static fn (array $data) => ProductStockMutationTypeV11::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/Stock/GetProductStockMutationTypes'),
            ),
        );
    }

    /**
     * Haal voor alle magazijnen van een of meer producten de minimale voorraadgrens, maximale voorraadgrens,
     * notitie en standaard picklocatie op.
     *
     * @param array{
     *     ProductIds?: array<int>,
     * } $parameters
     *
     * @return array<array-key, ProductStockWarehouseWithDefaultPickLocation>
     *
     * @throws Logic4ApiException
     */
    public function getProductStockWarehouseWithDefaultPickLocation(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => ProductStockWarehouseWithDefaultPickLocation::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Stock/GetProductStockWarehouseWithDefaultPickLocation', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Haal een voorraadcontrole op aan de hand van een Id.
     *
     * @throws Logic4ApiException
     */
    public function getStockControlHead(int $value): ProductStockControlHead
    {
        return ProductStockControlHead::make(
            $this->buildResponse(
                $this->getClient()->post('/v3/Stock/GetStockControlHead', ['json' => $value]),
            )
        );
    }

    /**
     * Voorraadcontrole heads ophalen op basis van het ProductStockControlHeadFilter.
     *
     * @param array{
     *     SkipRecords?: int,
     *     TakeRecords?: int,
     *     StockLocationId?: int|null,
     *     UserId?: int|null,
     *     CreatedDateFrom?: string|null,
     *     CreatedDateTo?: string|null,
     *     IsProcessed?: bool|null,
     *     ProductStockControlHeadId?: int|null,
     * } $parameters
     *
     * @return array<array-key, ProductStockControlHead>
     *
     * @throws Logic4ApiException
     */
    public function getStockControlHeads(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => ProductStockControlHead::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Stock/GetStockControlHeads', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Ophalen van voorraadstanden voor specifieke magazijnen.
     *
     * @param array{
     *     SkipRecords?: int,
     *     TakeRecords?: int,
     *     WareHouseId?: int|null,
     * } $parameters
     *
     * @return array<array-key, ProductStock>
     *
     * @throws Logic4ApiException
     */
    public function getStockForWarehouses(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => ProductStock::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Stock/GetStockForWarehouses', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Haal actuele voorraad op voor een artikel.
     *
     * @param array{
     *     ProductCode?: string|null,
     *     ProductIds?: array<int>,
     * } $parameters
     *
     * @return array<array-key, ProductStockInformationV2>
     *
     * @throws Logic4ApiException
     */
    public function getStockInformationForProduct(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => ProductStockInformationV2::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Stock/GetStockInformationForProduct', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Haal voorraadlocaties op van een product.
     *
     * @return array<array-key, ProductStockLocations>
     *
     * @throws Logic4ApiException
     */
    public function getStockLocationsForProduct(int $value): array
    {
        return array_map(
            static fn (array $data) => ProductStockLocations::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Stock/GetStockLocationsForProduct', ['json' => $value]),
            ),
        );
    }

    /**
     * Haal voorraadlocaties op van meerdere producten.
     *
     * @param array{
     *     ProductIds?: array<int>,
     * } $parameters
     *
     * @return array<array-key, ProductStockLocations>
     *
     * @throws Logic4ApiException
     */
    public function getStockLocationsForProducts(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => ProductStockLocations::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Stock/GetStockLocationsForProducts', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Verkrijg de producten die op de locatie aanwezig zouden moeten zijn.
     *
     * @param array{
     *     LocationId?: int,
     *     SkipRecords?: int,
     *     TakeRecords?: int,
     * } $parameters
     *
     * @return array<array-key, ProductStockControlRow>
     *
     * @throws Logic4ApiException
     */
    public function getStockProductsForStockLocation(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => ProductStockControlRow::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Stock/GetStockProductsForStockLocation', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Haal alle magazijnen op voor een administratie.
     *
     * @return array<array-key, WareHouse>
     *
     * @throws Logic4ApiException
     */
    public function getWarehousesForAdministration(int $value): array
    {
        return array_map(
            static fn (array $data) => WareHouse::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Stock/GetWarehousesForAdministration', ['json' => $value]),
            ),
        );
    }

    /**
     * Haal alle locaties op die bij een administratie behoren.
     *
     * @return array<array-key, WarehouseStockLocation>
     *
     * @throws Logic4ApiException
     */
    public function getWarehousesStockLocationsForAdministration(int $value): array
    {
        return array_map(
            static fn (array $data) => WarehouseStockLocation::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Stock/GetWarehousesStockLocationsForAdministration', ['json' => $value]),
            ),
        );
    }

    /**
     * Maak een voorraadverplaatsing aan.
     * Return True wanneer gelukt, anders foutmelding.
     *
     * @param array{
     *     Items?: array<array{ProductId?: int, MutationAmount?: number, OrderHeadPickbonId?: int|null}>,
     *     FromStockLocationId?: int|null,
     *     FromWarehouseId?: int|null,
     *     ToStockLocationId?: int,
     *     Notes?: string|null,
     *     Name?: string|null,
     *     DatabaseAdministrationId?: int,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function postCreateStockMovement(array $parameters = []): void
    {
        $this->getClient()->post('/v3/Stock/PostCreateStockMovement', ['json' => $parameters]);
    }

    /**
     * Wijzig externe voorraadstand van een leverancier.
     *
     * @param array{
     *     SupplierProductCode?: string|null,
     *     ProductId?: int|null,
     *     ProductCode?: string|null,
     *     SupplierId?: int|null,
     *     Quantity?: int|null,
     *     ProductNextDelivery?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function setExternalStockForSupplier(array $parameters = []): void
    {
        $this->getClient()->post('/v3/Stock/SetExternalStockForSupplier', ['json' => $parameters]);
    }

    /**
     * Voeg eerstvolgende leverdata van leveranciers toe voor één of meer artikelen (max 100 per request).
     *
     * @param array<array{
     *     ProductId?: int,
     *     SupplierId?: int,
     *     DeliveryDate?: string,
     * }> $parameters
     *
     * @throws Logic4ApiException
     */
    public function setNextDeliveriesDatesForActiveSuppliers(array $parameters = []): void
    {
        $this->getClient()->post('/v3/Stock/SetNextDeliveriesDatesForActiveSuppliers', ['json' => $parameters]);
    }

    /**
     * Verander de standaard picklocatie van artikelen naar een andere voorraad locatie.
     *
     * @param array<array{
     *     ProductId?: int,
     *     WarehouseStockLocationId?: int,
     *     WarehouseId?: int|null,
     * }> $parameters
     *
     * @throws Logic4ApiException
     */
    public function updateDefaultPickLocations(array $parameters = []): void
    {
        $this->getClient()->post('/v3/Stock/UpdateDefaultPickLocations', ['json' => $parameters]);
    }

    /**
     * Voeg een nieuwe voorraadcontrole toe of update de meegegeven head met de bijbehorende rijen als het Id van _head is meegegeven.
     *
     * @param array{
     *     CreatedDate?: string,
     *     Id?: int|null,
     *     LocationName?: string|null,
     *     LocationId?: int,
     *     ProcessDate?: string|null,
     *     Username?: string|null,
     *     UserId?: int|null,
     *     Rows?: array<array{Id?: int|null, ProductStockHeadId?: int|null, ProductId?: int, ProductDescription?: string|null, ProductDescription2?: string|null, Vendorcode?: string|null, StockTotal?: number, StockOnCurrentLocation?: number, StockCountedByUser?: number|null, StockLevelDate?: string, Barcode?: string|null, ProductCode?: string|null, Barcode2?: string|null, SystemBarcode?: string|null, BarcodeExtraList?: array<array{Barcode?: string|null, Qty?: int}>}>,
     *     EventLog?: string|null,
     *     WarehouseStockControlEmailTemplateId?: int|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function updateOrCreateStockControlHeads(
        array $parameters = [],
    ): ProductStockControlHead {
        return ProductStockControlHead::make(
            $this->buildResponse(
                $this->getClient()->post('/v3/Stock/UpdateOrCreateStockControlHeads', ['json' => $parameters]),
            )
        );
    }
}
