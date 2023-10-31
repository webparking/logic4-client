<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests;

use Webparking\Logic4Client\Data\BuyOrderBaseInfo;
use Webparking\Logic4Client\Data\BuyOrderRow;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\PaginatedResponse;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\BooleanLogic4Response;
use Webparking\Logic4Client\Responses\BuyOrderBaseInfoLogic4ResponseList;
use Webparking\Logic4Client\Responses\BuyOrderRowLogic4ResponseList;
use Webparking\Logic4Client\Responses\Int32ProductBuyOrderDeliveryRowListDictionaryLogic4Response;

class BuyOrder extends Request
{
    /**
     * Voeg een nieuwe inkooporderregel aan een bestaande inkooporder.
     *
     * @param array{
     *     BuyOrderId?: integer,
     *     OrderId?: integer,
     *     ProductCode?: string,
     *     ProductId?: integer,
     *     Price?: number,
     *     Description?: string,
     *     ProductDesc2?: string,
     *     ExpectedDeliveryDate?: string,
     *     QtyToOrder?: number,
     *     OrderedOnDateByDistributor?: string,
     *     OrderRowId?: integer,
     *     InternalNote?: string,
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
     *     BuyOrderRowId?: integer,
     *     BuyOrderId?: integer,
     *     DebtorName?: string,
     *     QtyToDeliver?: number,
     *     CreditorProductCode?: string,
     *     ProductDesc1?: string,
     *     StandardAmountQTY?: number,
     *     StandardAmountQTYUnitId?: integer,
     *     RepackingQty?: integer,
     *     OrderId?: integer,
     *     ProductCode?: string,
     *     ProductId?: integer,
     *     Price?: number,
     *     Description?: string,
     *     ProductDesc2?: string,
     *     ExpectedDeliveryDate?: string,
     *     QtyToOrder?: number,
     *     OrderedOnDateByDistributor?: string,
     *     OrderRowId?: integer,
     *     InternalNote?: string,
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
     *     CreditorId?: integer,
     *     DatabaseAdministrationId?: integer,
     *     CreatedAt?: string,
     *     BuyOrderRows?: array<mixed>,
     *     Remarks?: string,
     *     BranchId?: integer,
     *     OrderId?: integer,
     *     FreeValue1?: string,
     *     FreeValue2?: string,
     *     FreeValue3?: string,
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
    public function getBuyOrderRows(): BuyOrderRowLogic4ResponseList
    {
        return BuyOrderRowLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/BuyOrders/GetBuyOrderRows'),
            )
        );
    }

    /**
     * Haal inkoopordersregels op o.b.v. het meegestuurde filter.
     * <strong>Let op:</strong> het kan zijn dat niet alle inkoopregels van een bepaalde order worden opgehaald, doordat de uitvoer wordt gelimiteerd via de Skip- en TakeRecords.
     *
     * @param array{
     *     SkipRecords?: integer,
     *     TakeRecords?: integer,
     *     ProductId?: integer,
     *     ProductCode?: string,
     *     BuyOrderStatusId?: integer,
     *     IsDropShipment?: boolean,
     *     OrderId?: integer,
     *     BuyOrderId?: integer,
     * } $parameters
     *
     * @return PaginatedResponse<BuyOrderRow>
     *
     * @throws Logic4ApiException
     */
    public function getBuyOrderRowsByFilter(array $parameters = []): PaginatedResponse
    {
        return new PaginatedResponse(
            $this->paginateRecords('/v1.1/BuyOrders/GetBuyOrderRowsByFilter', $parameters),
            BuyOrderRow::class,
        );
    }

    /**
     * Haal per artikel openstaande inkoopordersregels op o.b.v. het meegestuurde filter.
     *
     * @param array{
     *     ProductIds?: array<integer>,
     *     Dropshipment?: boolean,
     *     MinimumDeliveryDate?: string,
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
     *     SkipRecords?: integer,
     *     TakeRecords?: integer,
     *     BranchId?: integer,
     *     BuyOrderIsClosed?: boolean,
     *     SupplierId?: integer,
     *     BuyOrderId?: integer,
     *     BuyOrderIdFrom?: integer,
     *     Remarks?: string,
     *     BuyOrderDateFrom?: string,
     *     BuyOrderDateTo?: string,
     *     FreeValue1?: string,
     *     FreeValue2?: string,
     *     FreeValue3?: string,
     * } $parameters
     *
     * @return PaginatedResponse<BuyOrderBaseInfo>
     *
     * @throws Logic4ApiException
     */
    public function getBuyOrders(array $parameters = []): PaginatedResponse
    {
        return new PaginatedResponse(
            $this->paginateRecords('/v1.1/BuyOrders/GetBuyOrders', $parameters),
            BuyOrderBaseInfo::class,
        );
    }

    /**
     * Wijzig een bestaande inkooporder.
     *
     * @param array{
     *     Id?: integer,
     *     CreditorId?: integer,
     *     Remarks?: string,
     *     BranchId?: integer,
     *     BuyOrderClosed?: boolean,
     *     CreatedAt?: string,
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
     *     BuyOrderRowId?: integer,
     *     OrderId?: integer,
     *     ProductCode?: string,
     *     ProductId?: integer,
     *     Price?: number,
     *     Description?: string,
     *     ProductDesc2?: string,
     *     ExpectedDeliveryDate?: string,
     *     QtyToOrder?: number,
     *     OrderedOnDateByDistributor?: string,
     *     OrderRowId?: integer,
     *     InternalNote?: string,
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
