<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V30;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V30\BuyOrderDeliveryAndOrderMovement;
use Webparking\Logic4Client\Responses\V30\BuyOrderDeliveryRead;
use Webparking\Logic4Client\Responses\V30\BuyOrderDeliveryStatusValue;
use Webparking\Logic4Client\Responses\V30\BuyOrderDeliveryTypeValue;

class BuyOrderDeliveryRequest extends Request
{
    /**
     * Maak een nieuwe inkooplevering aan.
     *
     * @param array{
     *     ProcessMutationButDoNotCreatePickbon?: bool,
     *     Status?: mixed,
     *     SupplierId?: int|null,
     *     BuyOrderId?: int|null,
     *     Remarks?: string|null,
     *     Description?: string|null,
     *     BranchId?: int|null,
     *     Rows?: array<array{BuyOrderRowId?: int|null, BuyPrice?: number|null, DebtorName?: string|null, OrderId?: int|null, ProductId?: int, Qty_Delivered?: number, Remarks?: string|null, StockLocationId?: int|null, AmountOfLabelsToPrint?: int|null}>,
     *     PickingListNumber?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function createBuyOrderDelivery(array $parameters = []): string
    {
        return $this->buildResponse(
            $this->getClient()->post('/v3/BuyOrderDeliveries/CreateBuyOrderDelivery', ['json' => $parameters]),
        );
    }

    /**
     * Maak een nieuwe inkooplevering aan, o.b.v. deze inkooplevering wordt automatisch een uitlevering aangemaakt.
     * Let op: de verkooporder kan enkel uitgeleverd worden als de betreffende inkooporderregel een OrderRowId heeft.
     *
     * @param array{
     *     OrderId?: int|null,
     *     ProcessMutationButDoNotCreatePickbon?: bool,
     *     Status?: mixed,
     *     SupplierId?: int|null,
     *     BuyOrderId?: int|null,
     *     Remarks?: string|null,
     *     Description?: string|null,
     *     BranchId?: int|null,
     *     Rows?: array<array{BuyOrderRowId?: int|null, BuyPrice?: number|null, DebtorName?: string|null, OrderId?: int|null, ProductId?: int, Qty_Delivered?: number, Remarks?: string|null, StockLocationId?: int|null, AmountOfLabelsToPrint?: int|null}>,
     *     PickingListNumber?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function createBuyOrderDeliveryAndOrderMovement(
        array $parameters = [],
    ): BuyOrderDeliveryAndOrderMovement {
        return BuyOrderDeliveryAndOrderMovement::make(
            $this->buildResponse(
                $this->getClient()->post('/v3/BuyOrderDeliveries/CreateBuyOrderDeliveryAndOrderMovement', ['json' => $parameters]),
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
     * @return array<array-key, BuyOrderDeliveryRead>
     *
     * @throws Logic4ApiException
     */
    public function getBuyOrderDeliveries(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => BuyOrderDeliveryRead::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/BuyOrderDeliveries/GetBuyOrderDeliveries', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Verkrijg alle beschikbare inkooplevering statussen.
     *
     * @return array<array-key, BuyOrderDeliveryStatusValue>
     *
     * @throws Logic4ApiException
     */
    public function getBuyOrderDeliveryStatusses(): array
    {
        return array_map(
            static fn (array $data) => BuyOrderDeliveryStatusValue::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/BuyOrderDeliveries/GetBuyOrderDeliveryStatusses'),
            ),
        );
    }

    /**
     * Verkrijg alle beschikbare inkooplevering types.
     *
     * @return array<array-key, BuyOrderDeliveryTypeValue>
     *
     * @throws Logic4ApiException
     */
    public function getBuyOrderDeliveryTypes(): array
    {
        return array_map(
            static fn (array $data) => BuyOrderDeliveryTypeValue::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/BuyOrderDeliveries/GetBuyOrderDeliveryTypes'),
            ),
        );
    }

    /**
     * Wijzig de inkooplevering.
     * Enkel statusId 3 of 5 zijn toegestaan.
     *
     * @param array{
     *     Id?: int,
     *     Description?: string|null,
     *     PickingListNr?: string|null,
     *     Remarks?: string|null,
     *     StatusId?: int|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function updateBuyOrderDelivery(array $parameters = []): void
    {
        $this->getClient()->patch('/v3/BuyOrderDeliveries/UpdateBuyOrderDelivery', ['json' => $parameters]);
    }
}
