<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\BuyOrderDeliveryAndOrderMovementLogic4Response;
use Webparking\Logic4Client\Responses\BuyOrderDeliveryStatusValueLogic4Response;
use Webparking\Logic4Client\Responses\StringLogic4Response;

class BuyOrderDelivery extends Request
{
    /**
     * Maak een nieuwe inkooplevering aan of update een bestaande.
     *
     * @param array{
     *     ProcessMutationButDoNotCreatePickbon?: boolean,
     *     BuyOrderDeliveryId?: integer,
     *     SupplierId?: integer,
     *     BuyOrderId?: integer,
     *     Remarks?: string,
     *     Description?: string,
     *     BranchId?: integer,
     *     Rows?: array<mixed>,
     *     Status?: string,
     *     PickingListNumber?: string,
     *     OrderId?: integer,
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
     *
     * @param array{
     *     BuyOrderDeliveryId?: integer,
     *     SupplierId?: integer,
     *     BuyOrderId?: integer,
     *     Remarks?: string,
     *     Description?: string,
     *     BranchId?: integer,
     *     Rows?: array<mixed>,
     *     Status?: string,
     *     PickingListNumber?: string,
     *     OrderId?: integer,
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
     * Verkrijg alle beschikbare inkooplevering statussen.
     *
     * @throws Logic4ApiException
     */
    public function getBuyOrderDeliveryStatusses(
    ): BuyOrderDeliveryStatusValueLogic4Response {
        return BuyOrderDeliveryStatusValueLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/BuyOrderDeliveries/GetBuyOrderDeliveryStatusses'),
            )
        );
    }
}
