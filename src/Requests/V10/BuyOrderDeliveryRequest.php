<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V10;

use Webparking\Logic4Client\Data\V10\BuyOrderDeliveryRead;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V10\BuyOrderDeliveryAndOrderMovementLogic4Response;
use Webparking\Logic4Client\Responses\V10\BuyOrderDeliveryStatusValueLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\BuyOrderDeliveryTypeValueLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\StringLogic4Response;

class BuyOrderDeliveryRequest extends Request
{
    /**
     * Maak een nieuwe inkooplevering aan of update een bestaande.
     *
     * @param array{
     *     ProcessMutationButDoNotCreatePickbon?: bool|null,
     *     Status?: string|null,
     *     SupplierId?: int|null,
     *     BuyOrderId?: int|null,
     *     Remarks?: string|null,
     *     Description?: string|null,
     *     BranchId?: int|null,
     *     Rows?: array<array{BuyOrderRowId?: int|null, BuyPrice?: number|null, DebtorName?: string|null, OrderId?: int|null, ProductId?: int, Qty_Delivered?: number, Remarks?: string|null, StockLocationId?: int|null, AmountOfLabelsToPrint?: int|null}>|null,
     *     PickingListNumber?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function createBuyOrderDelivery(
        array $parameters = [],
    ): StringLogic4Response {
        return StringLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/BuyOrderDeliveries/CreateBuyOrderDelivery', ['json' => $parameters]),
            )
        );
    }

    /**
     * Maak een nieuwe inkooplevering aan, o.b.v. deze inkooplevering wordt automatisch een uitlevering aangemaakt.
     * Let op: de uitlevering kan enkel uitgevoerd worden als alle inkooporderregels zijn voorzien van OrderRowId.
     *
     * @param array{
     *     OrderId?: int|null,
     *     ProcessMutationButDoNotCreatePickbon?: bool|null,
     *     Status?: string|null,
     *     SupplierId?: int|null,
     *     BuyOrderId?: int|null,
     *     Remarks?: string|null,
     *     Description?: string|null,
     *     BranchId?: int|null,
     *     Rows?: array<array{BuyOrderRowId?: int|null, BuyPrice?: number|null, DebtorName?: string|null, OrderId?: int|null, ProductId?: int, Qty_Delivered?: number, Remarks?: string|null, StockLocationId?: int|null, AmountOfLabelsToPrint?: int|null}>|null,
     *     PickingListNumber?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function createBuyOrderDeliveryAndOrderMovement(
        array $parameters = [],
    ): BuyOrderDeliveryAndOrderMovementLogic4Response {
        return BuyOrderDeliveryAndOrderMovementLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/BuyOrderDeliveries/CreateBuyOrderDeliveryAndOrderMovement', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg alle beschikbare inkoopleveringen, het aantal op te vragen inkoopleveringen is gelimiteerd tot 1000.
     *
     * @param array{
     *     CreationDateFrom?: string|null,
     *     BuyOrderDeliveryId?: int|null,
     *     BuyOrderId?: int|null,
     *     BranchId?: int|null,
     *     SupplierId?: int|null,
     *     StatusId?: int|null,
     *     TypeId?: int|null,
     *     Skip?: int|null,
     *     Take?: int|null,
     * } $parameters
     *
     * @return \Generator<array-key, BuyOrderDeliveryRead>
     *
     * @throws Logic4ApiException
     */
    public function getBuyOrderDeliveries(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1/BuyOrderDeliveries/GetBuyOrderDeliveries', $parameters, 'Take', 'Skip');

        foreach ($iterator as $record) {
            yield BuyOrderDeliveryRead::make($record);
        }
    }

    /**
     * Verkrijg alle beschikbare inkooplevering statussen.
     *
     * @throws Logic4ApiException
     */
    public function getBuyOrderDeliveryStatusses(
    ): BuyOrderDeliveryStatusValueLogic4ResponseList {
        return BuyOrderDeliveryStatusValueLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/BuyOrderDeliveries/GetBuyOrderDeliveryStatusses'),
            )
        );
    }

    /**
     * Verkrijg alle beschikbare inkooplevering types.
     *
     * @throws Logic4ApiException
     */
    public function getBuyOrderDeliveryTypes(
    ): BuyOrderDeliveryTypeValueLogic4ResponseList {
        return BuyOrderDeliveryTypeValueLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/BuyOrderDeliveries/GetBuyOrderDeliveryTypes'),
            )
        );
    }
}
