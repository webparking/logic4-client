<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests;

use Webparking\Logic4Client\Data\BuyOrderBaseInfo;
use Webparking\Logic4Client\Data\BuyOrderRow;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\BooleanLogic4Response;
use Webparking\Logic4Client\Responses\BuyOrderBaseInfoLogic4ResponseList;
use Webparking\Logic4Client\Responses\BuyOrderRowLogic4ResponseList;
use Webparking\Logic4Client\Responses\Int32ProductBuyOrderDeliveryRowListDictionaryLogic4Response;

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
     * @deprecated Let op! Functie is verouderd. Implementeer een alternatief. - Inkooporderregel aanmaken of updaten
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
     *     BuyOrderRows?: array<array{BuyOrderRowId?: integer, BuyOrderId?: integer, DebtorName?: string, QtyToDeliver?: number, CreditorProductCode?: string, ProductDesc1?: string, StandardAmountQTY?: number, StandardAmountQTYUnitId?: integer, RepackingQty?: integer, OrderId?: integer, ProductCode?: string, ProductId?: integer, Price?: number, Description?: string, ProductDesc2?: string, ExpectedDeliveryDate?: string, QtyToOrder?: number, OrderedOnDateByDistributor?: string, OrderRowId?: integer, InternalNote?: string}>|null,
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
     * <strong>Let op:</strong> het kan zijn dat niet alle inkoopregels van een bepaalde order worden opgehaald, doordat de uitvoer wordt gelimiteerd via de Skip- en TakeRecords.
     *
     * @param array{
     *     SkipRecords?: integer|null,
     *     TakeRecords?: integer|null,
     *     ProductId?: integer|null,
     *     ProductCode?: string|null,
     *     BuyOrderStatusId?: integer|null,
     *     IsDropShipment?: boolean|null,
     *     OrderId?: integer|null,
     *     BuyOrderId?: integer|null,
     * } $parameters
     *
     * @return \Generator<array-key, BuyOrderRow>
     *
     * @throws Logic4ApiException
     */
    public function getBuyOrderRowsByFilter(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1.1/BuyOrders/GetBuyOrderRowsByFilter', $parameters);

        foreach ($iterator as $record) {
            yield BuyOrderRow::make($record);
        }
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
     * Haal inkooporders op o.b.v. het meegestuurde filter. De hoeveelheid inkooporders wordt gelimiteerd aan de hand van opgegeven SkipRecords en TakeRecords.
     * TakeRecords wordt gelimiteerd op 10.000.
     *
     * @param array{
     *     SkipRecords?: integer|null,
     *     TakeRecords?: integer|null,
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
     * @return \Generator<array-key, BuyOrderBaseInfo>
     *
     * @throws Logic4ApiException
     */
    public function getBuyOrders(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1.1/BuyOrders/GetBuyOrders', $parameters);

        foreach ($iterator as $record) {
            yield BuyOrderBaseInfo::make($record);
        }
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
    public function updateBuyOrderRow(array $parameters = []): BooleanLogic4Response
    {
        return BooleanLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->patch('/v1/BuyOrders/UpdateBuyOrderRow', ['json' => $parameters]),
            )
        );
    }
}
