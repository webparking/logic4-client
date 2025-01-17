<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V10;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V10\BooleanLogic4Response;
use Webparking\Logic4Client\Responses\V10\BuyOrderBaseInfoLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\BuyOrderRowLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\Int32ProductBuyOrderDeliveryRowListDictionaryLogic4Response;

class BuyOrderRequest extends Request
{
    /**
     * Voeg een nieuwe inkooporderregel aan een bestaande inkooporder.
     *
     * @param array{
     *     BuyOrderId?: integer|null,
     *     OrderId?: integer|null,
     *     ProductCode?: string|null,
     *     ProductId?: integer|null,
     *     Price?: number|null,
     *     Description?: string|null,
     *     ProductDesc2?: string|null,
     *     ExpectedDeliveryDate?: string|null,
     *     QtyToOrder?: number|null,
     *     OrderedOnDateByDistributor?: string|null,
     *     OrderRowId?: integer|null,
     *     InternalNote?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addBuyOrderRow(array $parameters = []): BooleanLogic4Response
    {
        return BooleanLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/BuyOrders/AddBuyOrderRow', ['json' => $parameters]),
            )
        );
    }

    /**
     * Voeg een nieuwe inkooporderregel toe of update een bestaande regel.
     *
     * @param array{
     *     BuyOrderRowId?: integer|null,
     *     BuyOrderId?: integer|null,
     *     DebtorName?: string|null,
     *     QtyToDeliver?: number|null,
     *     CreditorProductCode?: string|null,
     *     ProductDesc1?: string|null,
     *     StandardAmountQTY?: number|null,
     *     StandardAmountQTYUnitId?: integer|null,
     *     RepackingQty?: integer|null,
     *     OrderId?: integer|null,
     *     ProductCode?: string|null,
     *     ProductId?: integer|null,
     *     Price?: number|null,
     *     Description?: string|null,
     *     ProductDesc2?: string|null,
     *     ExpectedDeliveryDate?: string|null,
     *     QtyToOrder?: number|null,
     *     OrderedOnDateByDistributor?: string|null,
     *     OrderRowId?: integer|null,
     *     InternalNote?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     *
     * @deprecated Let op! Versie 1.0 is verouderd. Gebruik een nieuwere versie. - Inkooporderregel aanmaken of updaten
     */
    public function addUpdateBuyOrderRow(
        array $parameters = [],
    ): BooleanLogic4Response {
        return BooleanLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/BuyOrders/AddUpdateBuyOrderRow', ['json' => $parameters]),
            )
        );
    }

    /**
     * Maak een nieuwe inkooporder.
     *
     * @param array{
     *     CreditorId?: integer|null,
     *     DatabaseAdministrationId?: integer|null,
     *     CreatedAt?: string|null,
     *     BuyOrderRows?: array<array{BuyOrderRowId?: integer, BuyOrderId?: integer, DebtorName?: string|null, QtyToDeliver?: number, CreditorProductCode?: string|null, ProductDesc1?: string|null, StandardAmountQTY?: number|null, StandardAmountQTYUnitId?: integer|null, RepackingQty?: integer|null, OrderId?: integer|null, ProductCode?: string|null, ProductId?: integer|null, Price?: number, Description?: string|null, ProductDesc2?: string|null, ExpectedDeliveryDate?: string|null, QtyToOrder?: number, OrderedOnDateByDistributor?: string|null, OrderRowId?: integer|null, InternalNote?: string|null}>|null,
     *     Remarks?: string|null,
     *     BranchId?: integer|null,
     *     OrderId?: integer|null,
     *     FreeValue1?: string|null,
     *     FreeValue2?: string|null,
     *     FreeValue3?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function createBuyOrder(
        array $parameters = [],
    ): BuyOrderBaseInfoLogic4ResponseList {
        return BuyOrderBaseInfoLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/BuyOrders/CreateBuyOrder', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg de inkooporder regels voor een bepaalde inkooporder die al besteld zijn bij de leverancier.
     *
     * @throws Logic4ApiException
     */
    public function getBuyOrderRows(int $value): BuyOrderRowLogic4ResponseList
    {
        return BuyOrderRowLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/BuyOrders/GetBuyOrderRows', ['json' => $value]),
            )
        );
    }

    /**
     * Haal inkoopordersregels op o.b.v. het meegestuurde filter.
     *
     * @param array{
     *     ProductId?: integer|null,
     *     ProductCode?: string|null,
     *     BuyOrderStatusId?: integer|null,
     *     IsDropShipment?: boolean|null,
     *     OrderId?: integer|null,
     *     BuyOrderId?: integer|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     *
     * @deprecated Let op! Versie 1.0 is verouderd. Gebruik versie v1.1. - Inkoopordersregels ophalen o.b.v. filter
     */
    public function getBuyOrderRowsByFilter(
        array $parameters = [],
    ): BuyOrderRowLogic4ResponseList {
        return BuyOrderRowLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/BuyOrders/GetBuyOrderRowsByFilter', ['json' => $parameters]),
            )
        );
    }

    /**
     * Haal per artikel openstaande inkoopordersregels op o.b.v. het meegestuurde filter.
     *
     * @param array{
     *     ProductIds?: array<integer>|null,
     *     Dropshipment?: boolean|null,
     *     MinimumDeliveryDate?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getBuyOrderRowsPerProduct(
        array $parameters = [],
    ): Int32ProductBuyOrderDeliveryRowListDictionaryLogic4Response {
        return Int32ProductBuyOrderDeliveryRowListDictionaryLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/BuyOrders/GetBuyOrderRowsPerProduct', ['json' => $parameters]),
            )
        );
    }

    /**
     * Haal inkooporders op o.b.v. het meegestuurde filter.
     *
     * @param array{
     *     BranchId?: integer|null,
     *     BuyOrderIsClosed?: boolean|null,
     *     SupplierId?: integer|null,
     *     BuyOrderId?: integer|null,
     *     BuyOrderIdFrom?: integer|null,
     *     Remarks?: string|null,
     *     BuyOrderDateFrom?: string|null,
     *     BuyOrderDateTo?: string|null,
     *     FreeValue1?: string|null,
     *     FreeValue2?: string|null,
     *     FreeValue3?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     *
     * @deprecated Let op! Versie 1.0 is verouderd. Gebruik versie v1.1. - Inkooporders ophalen o.b.v. filter.
     */
    public function getBuyOrders(
        array $parameters = [],
    ): BuyOrderBaseInfoLogic4ResponseList {
        return BuyOrderBaseInfoLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/BuyOrders/GetBuyOrders', ['json' => $parameters]),
            )
        );
    }

    /**
     * Wijzig een bestaande inkooporder.
     *
     * @param array{
     *     Id?: integer|null,
     *     CreditorId?: integer|null,
     *     Remarks?: string|null,
     *     BranchId?: integer|null,
     *     BuyOrderClosed?: boolean|null,
     *     CreatedAt?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function updateBuyOrder(
        array $parameters = [],
    ): BuyOrderBaseInfoLogic4ResponseList {
        return BuyOrderBaseInfoLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/BuyOrders/UpdateBuyOrder', ['json' => $parameters]),
            )
        );
    }

    /**
     * Update een bestaande inkooporderregel.
     *
     * @param array{
     *     BuyOrderRowId?: integer|null,
     *     OrderId?: integer|null,
     *     ProductCode?: string|null,
     *     ProductId?: integer|null,
     *     Price?: number|null,
     *     Description?: string|null,
     *     ProductDesc2?: string|null,
     *     ExpectedDeliveryDate?: string|null,
     *     QtyToOrder?: number|null,
     *     OrderedOnDateByDistributor?: string|null,
     *     OrderRowId?: integer|null,
     *     InternalNote?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function updateBuyOrderRow(
        array $parameters = [],
    ): BooleanLogic4Response {
        return BooleanLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->patch('/v1/BuyOrders/UpdateBuyOrderRow', ['json' => $parameters]),
            )
        );
    }
}
