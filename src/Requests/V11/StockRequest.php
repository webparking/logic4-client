<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V11;

use Webparking\Logic4Client\Data\V11\ProductStock;
use Webparking\Logic4Client\Data\V11\ProductStockControlHead;
use Webparking\Logic4Client\Data\V11\ProductStockControlRow;
use Webparking\Logic4Client\Data\V11\ProductStockMutation;
use Webparking\Logic4Client\Data\V11\ProductStockSuppliers;
use Webparking\Logic4Client\Data\V11\ProductSupplierNextDelivery;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V11\BooleanLogic4Response;
use Webparking\Logic4Client\Responses\V11\ProductStockMutationTypeV11Logic4ResponseList;

class StockRequest extends Request
{
    /**
     * Ophalen van externe voorraadstanden voor actieve leveranciers.
     *
     * @param array{
     *     SkipRecords?: int|null,
     *     TakeRecords?: int|null,
     *     ProductStockFrom?: int|null,
     *     DateTimeLastUpdateSince?: string|null,
     * } $parameters
     *
     * @return \Generator<array-key, ProductStockSuppliers>
     *
     * @throws Logic4ApiException
     */
    public function getExternalStockForActiveSuppliers(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1.1/Stock/GetExternalStockForActiveSuppliers', $parameters);

        foreach ($iterator as $record) {
            yield ProductStockSuppliers::make($record);
        }
    }

    /**
     * Verkrijg de eerst volgende leverdata van alle actieve leveranciers, vanaf een specifieke datum.
     *
     * @param array{
     *     NextDeliveryDate?: string|null,
     *     SkipRecords?: int|null,
     *     TakeRecords?: int|null,
     * } $parameters
     *
     * @return \Generator<array-key, ProductSupplierNextDelivery>
     *
     * @throws Logic4ApiException
     */
    public function getNextDeliveriesDatesForActiveSuppliers(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1.1/Stock/GetNextDeliveriesDatesForActiveSuppliers', $parameters);

        foreach ($iterator as $record) {
            yield ProductSupplierNextDelivery::make($record);
        }
    }

    /**
     * Haal voorraadmutaties op. Maximaal 10000 records per keer kunnen worden opgehaald.
     *
     * @param array{
     *     SkipRecords?: int|null,
     *     TakeRecords?: int|null,
     *     PickbonIds?: array<int>|null,
     *     DateFrom?: string|null,
     *     DateTo?: string|null,
     *     BuyOrderId?: int|null,
     *     StocklocationId?: int|null,
     *     ITSIssueId?: int|null,
     *     ProductCode?: string|null,
     *     WareHouseId?: int|null,
     * } $parameters
     *
     * @return \Generator<array-key, ProductStockMutation>
     *
     * @throws Logic4ApiException
     */
    public function getProductStockMutations(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1.1/Stock/GetProductStockMutations', $parameters);

        foreach ($iterator as $record) {
            yield ProductStockMutation::make($record);
        }
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
     * Voorraadcontrole heads ophalen op basis van het ProductStockControlHeadFilter.
     *
     * @param array{
     *     SkipRecords?: int|null,
     *     TakeRecords?: int|null,
     *     StockLocationId?: int|null,
     *     UserId?: int|null,
     *     CreatedDateFrom?: string|null,
     *     CreatedDateTo?: string|null,
     *     IsProcessed?: bool|null,
     *     ProductStockControlHeadId?: int|null,
     * } $parameters
     *
     * @return \Generator<array-key, ProductStockControlHead>
     *
     * @throws Logic4ApiException
     */
    public function getStockControlHeads(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1.1/Stock/GetStockControlHeads', $parameters);

        foreach ($iterator as $record) {
            yield ProductStockControlHead::make($record);
        }
    }

    /**
     * Ophalen van voorraadstanden voor specifieke magazijnen.
     *
     * @param array{
     *     SkipRecords?: int|null,
     *     TakeRecords?: int|null,
     *     WareHouseId?: int|null,
     * } $parameters
     *
     * @return \Generator<array-key, ProductStock>
     *
     * @throws Logic4ApiException
     */
    public function getStockForWarehouses(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1.1/Stock/GetStockForWarehouses', $parameters);

        foreach ($iterator as $record) {
            yield ProductStock::make($record);
        }
    }

    /**
     * Verkrijg de producten die op de locatie aanwezig zouden moeten zijn.
     *
     * @param array{
     *     LocationId?: int|null,
     *     SkipRecords?: int|null,
     *     TakeRecords?: int|null,
     * } $parameters
     *
     * @return \Generator<array-key, ProductStockControlRow>
     *
     * @throws Logic4ApiException
     */
    public function getStockProductsForStockLocation(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1.1/Stock/GetStockProductsForStockLocation', $parameters);

        foreach ($iterator as $record) {
            yield ProductStockControlRow::make($record);
        }
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
     * Verander de standaard picklocatie van artikelen naar een andere voorraad locatie.
     *
     * @param array<array{
     *     ProductId?: int|null,
     *     WarehouseStockLocationId?: int|null,
     *     WarehouseId?: int|null,
     * }> $parameters
     *
     * @throws Logic4ApiException
     */
    public function updateDefaultPickLocations(
        array $parameters = [],
    ): BooleanLogic4Response {
        return BooleanLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.1/Stock/UpdateDefaultPickLocations', ['json' => $parameters]),
            )
        );
    }
}
