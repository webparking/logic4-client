<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V10;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfBuyOrderBaseInfo;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfBuyOrderRow;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseOfboolean;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseOfBuyOrderBaseInfo;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseOfDictionaryOfintAndListOfProductBuyOrderDeliveryRow;

class BuyOrderRequest extends Request
{
    /**
     * Voeg een nieuwe inkooporderregel aan een bestaande inkooporder.
     *
     * @param array{
     *     BuyOrderId?: int,
     *     OrderId?: int|null,
     *     ProductCode?: string|null,
     *     ProductId?: int|null,
     *     Price?: number,
     *     Description?: string|null,
     *     ProductDesc2?: string|null,
     *     ExpectedDeliveryDate?: string|null,
     *     QtyToOrder?: number,
     *     OrderedOnDateByDistributor?: string|null,
     *     OrderRowId?: int|null,
     *     InternalNote?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addBuyOrderRow(
        array $parameters = [],
    ): Logic4ResponseOfboolean {
        return Logic4ResponseOfboolean::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/BuyOrders/AddBuyOrderRow', ['json' => $parameters]),
            )
        );
    }

    /**
     * Voeg een nieuwe inkooporderregel toe of update een bestaande regel.
     *
     * @param array{
     *     BuyOrderRowId?: int,
     *     BuyOrderId?: int,
     *     DebtorName?: string|null,
     *     QtyToDeliver?: number,
     *     CreditorProductCode?: string|null,
     *     ProductDesc1?: string|null,
     *     StandardAmountQTY?: number|null,
     *     StandardAmountQTYUnitId?: int|null,
     *     RepackingQty?: int|null,
     *     OrderId?: int|null,
     *     ProductCode?: string|null,
     *     ProductId?: int|null,
     *     Price?: number,
     *     Description?: string|null,
     *     ProductDesc2?: string|null,
     *     ExpectedDeliveryDate?: string|null,
     *     QtyToOrder?: number,
     *     OrderedOnDateByDistributor?: string|null,
     *     OrderRowId?: int|null,
     *     InternalNote?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addUpdateBuyOrderRow(
        array $parameters = [],
    ): Logic4ResponseOfboolean {
        return Logic4ResponseOfboolean::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/BuyOrders/AddUpdateBuyOrderRow', ['json' => $parameters]),
            )
        );
    }

    /**
     * Maak een nieuwe inkooporder.
     *
     * @param array{
     *     CreditorId?: int,
     *     DatabaseAdministrationId?: int,
     *     CreatedAt?: string,
     *     BuyOrderRows?: array<array{BuyOrderRowId?: int, BuyOrderId?: int, DebtorName?: string|null, QtyToDeliver?: number, CreditorProductCode?: string|null, ProductDesc1?: string|null, StandardAmountQTY?: number|null, StandardAmountQTYUnitId?: int|null, RepackingQty?: int|null, OrderId?: int|null, ProductCode?: string|null, ProductId?: int|null, Price?: number, Description?: string|null, ProductDesc2?: string|null, ExpectedDeliveryDate?: string|null, QtyToOrder?: number, OrderedOnDateByDistributor?: string|null, OrderRowId?: int|null, InternalNote?: string|null}>,
     *     Remarks?: string|null,
     *     BranchId?: int|null,
     *     OrderId?: int|null,
     *     FreeValue1?: string|null,
     *     FreeValue2?: string|null,
     *     FreeValue3?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function createBuyOrder(
        array $parameters = [],
    ): Logic4ResponseOfBuyOrderBaseInfo {
        return Logic4ResponseOfBuyOrderBaseInfo::make(
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
    public function getBuyOrderRows(int $value): Logic4ResponseListOfBuyOrderRow
    {
        return Logic4ResponseListOfBuyOrderRow::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/BuyOrders/GetBuyOrderRows', ['json' => $value]),
            )
        );
    }

    /**
     * Haal inkoopordersregels op o.b.v. het meegestuurde filter.
     *
     * @param array{
     *     ProductId?: int|null,
     *     ProductCode?: string|null,
     *     BuyOrderStatusId?: int|null,
     *     IsDropShipment?: bool|null,
     *     OrderId?: int|null,
     *     BuyOrderId?: int|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getBuyOrderRowsByFilter(
        array $parameters = [],
    ): Logic4ResponseListOfBuyOrderRow {
        return Logic4ResponseListOfBuyOrderRow::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/BuyOrders/GetBuyOrderRowsByFilter', ['json' => $parameters]),
            )
        );
    }

    /**
     * Haal per artikel openstaande inkoopordersregels op o.b.v. het meegestuurde filter.
     *
     * @param array{
     *     ProductIds?: array<int>,
     *     Dropshipment?: bool|null,
     *     MinimumDeliveryDate?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getBuyOrderRowsPerProduct(
        array $parameters = [],
    ): Logic4ResponseOfDictionaryOfintAndListOfProductBuyOrderDeliveryRow {
        return Logic4ResponseOfDictionaryOfintAndListOfProductBuyOrderDeliveryRow::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/BuyOrders/GetBuyOrderRowsPerProduct', ['json' => $parameters]),
            )
        );
    }

    /**
     * Haal inkooporders op o.b.v. het meegestuurde filter.
     *
     * @param array{
     *     BranchId?: int|null,
     *     BuyOrderIsClosed?: bool|null,
     *     SupplierId?: int|null,
     *     BuyOrderId?: int|null,
     *     BuyOrderIdFrom?: int|null,
     *     Remarks?: string|null,
     *     BuyOrderDateFrom?: string|null,
     *     BuyOrderDateTo?: string|null,
     *     FreeValue1?: string|null,
     *     FreeValue2?: string|null,
     *     FreeValue3?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getBuyOrders(
        array $parameters = [],
    ): Logic4ResponseListOfBuyOrderBaseInfo {
        return Logic4ResponseListOfBuyOrderBaseInfo::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/BuyOrders/GetBuyOrders', ['json' => $parameters]),
            )
        );
    }

    /**
     * Wijzig een bestaande inkooporder.
     *
     * @param array{
     *     Id?: int|null,
     *     CreditorId?: int,
     *     Remarks?: string|null,
     *     BranchId?: int|null,
     *     BuyOrderClosed?: bool,
     *     CreatedAt?: string,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function updateBuyOrder(
        array $parameters = [],
    ): Logic4ResponseOfBuyOrderBaseInfo {
        return Logic4ResponseOfBuyOrderBaseInfo::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/BuyOrders/UpdateBuyOrder', ['json' => $parameters]),
            )
        );
    }

    /**
     * Update een bestaande inkooporderregel.
     *
     * @param array{
     *     BuyOrderRowId?: int,
     *     OrderId?: int|null,
     *     ProductCode?: string|null,
     *     ProductId?: int|null,
     *     Price?: number,
     *     Description?: string|null,
     *     ProductDesc2?: string|null,
     *     ExpectedDeliveryDate?: string|null,
     *     QtyToOrder?: number,
     *     OrderedOnDateByDistributor?: string|null,
     *     OrderRowId?: int|null,
     *     InternalNote?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function updateBuyOrderRow(
        array $parameters = [],
    ): Logic4ResponseOfboolean {
        return Logic4ResponseOfboolean::make(
            $this->buildResponse(
                $this->getClient()->patch('/v1/BuyOrders/UpdateBuyOrderRow', ['json' => $parameters]),
            )
        );
    }
}
