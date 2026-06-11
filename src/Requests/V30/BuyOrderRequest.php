<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V30;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V30\BuyOrderBaseInfo;
use Webparking\Logic4Client\Responses\V30\BuyOrderGetInfo;
use Webparking\Logic4Client\Responses\V30\BuyOrderRow;

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
    public function addBuyOrderRow(array $parameters = []): void
    {
        $this->getClient()->post('/v3/BuyOrders/AddBuyOrderRow', ['json' => $parameters]);
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
    public function createBuyOrder(array $parameters = []): BuyOrderBaseInfo
    {
        return BuyOrderBaseInfo::make(
            $this->buildResponse(
                $this->getClient()->post('/v3/BuyOrders/CreateBuyOrder', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg de inkooporder regels voor een bepaalde inkooporder die al besteld zijn bij de leverancier.
     *
     * @return array<array-key, BuyOrderRow>
     *
     * @throws Logic4ApiException
     */
    public function getBuyOrderRows(int $value): array
    {
        return array_map(
            static fn (array $data) => BuyOrderRow::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/BuyOrders/GetBuyOrderRows', ['json' => $value]),
            ),
        );
    }

    /**
     * Haal inkoopordersregels op o.b.v. het meegestuurde filter.
     * <strong>Let op:</strong> het kan zijn dat niet alle inkoopregels van een bepaalde order worden opgehaald, doordat de uitvoer wordt gelimiteerd via de Skip- en TakeRecords.
     *
     * @param array{
     *     SkipRecords?: int,
     *     TakeRecords?: int,
     *     ProductId?: int|null,
     *     ProductCode?: string|null,
     *     BuyOrderStatusId?: int|null,
     *     IsDropShipment?: bool|null,
     *     OrderId?: int|null,
     *     BuyOrderId?: int|null,
     * } $parameters
     *
     * @return array<array-key, BuyOrderRow>
     *
     * @throws Logic4ApiException
     */
    public function getBuyOrderRowsByFilter(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => BuyOrderRow::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/BuyOrders/GetBuyOrderRowsByFilter', ['json' => $parameters]),
            ),
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
    public function getBuyOrderRowsPerProduct(array $parameters = []): object
    {
        return $this->buildResponse(
            $this->getClient()->post('/v3/BuyOrders/GetBuyOrderRowsPerProduct', ['json' => $parameters]),
        );
    }

    /**
     * Haal inkooporders op o.b.v. het meegestuurde filter. De hoeveelheid inkooporders wordt gelimiteerd aan de hand van opgegeven SkipRecords en TakeRecords.
     * TakeRecords wordt gelimiteerd op 10.000.
     *
     * @param array{
     *     SkipRecords?: int,
     *     TakeRecords?: int,
     *     DateTimeChangedFrom?: string|null,
     *     DateTimeChangedTo?: string|null,
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
     * @return array<array-key, BuyOrderGetInfo>
     *
     * @throws Logic4ApiException
     */
    public function getBuyOrders(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => BuyOrderGetInfo::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/BuyOrders/GetBuyOrders', ['json' => $parameters]),
            ),
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
     * @return array<array-key, BuyOrderBaseInfo>
     *
     * @throws Logic4ApiException
     */
    public function updateBuyOrder(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => BuyOrderBaseInfo::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/BuyOrders/UpdateBuyOrder', ['json' => $parameters]),
            ),
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
    public function updateBuyOrderRow(array $parameters = []): void
    {
        $this->getClient()->patch('/v3/BuyOrders/UpdateBuyOrderRow', ['json' => $parameters]);
    }
}
