<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V11;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V11\BuyOrderDeliveryAndOrderMovementLogic4Response;

class BuyOrderDeliveryRequest extends Request
{
    /**
     * Maak een nieuwe inkooplevering aan, o.b.v. deze inkooplevering wordt automatisch een uitlevering aangemaakt.
     * Let op: de verkooporder kan enkel uitgeleverd worden als de betreffende inkooporderregel een OrderRowId heeft.
     *
     * @param array{
     *     OrderId?: integer|null,
     *     ProcessMutationButDoNotCreatePickbon?: boolean|null,
     *     Status?: string|null,
     *     SupplierId?: integer|null,
     *     BuyOrderId?: integer|null,
     *     Remarks?: string|null,
     *     Description?: string|null,
     *     BranchId?: integer|null,
     *     Rows?: array<array{BuyOrderRowId?: integer, BuyPrice?: number, DebtorName?: string, OrderId?: integer, ProductId?: integer, Qty_Delivered?: number, Remarks?: string, StockLocationId?: integer, AmountOfLabelsToPrint?: integer}>|null,
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
                $this->getClient()->post('/v1.1/BuyOrderDeliveries/CreateBuyOrderDeliveryAndOrderMovement', ['json' => $parameters]),
            )
        );
    }
}
