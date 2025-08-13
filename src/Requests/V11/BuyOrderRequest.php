<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V11;

use Webparking\Logic4Client\Data\V11\BuyOrderGetInfo;
use Webparking\Logic4Client\Data\V11\BuyOrderRow;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;

class BuyOrderRequest extends Request
{
    /**
     * Haal inkoopordersregels op o.b.v. het meegestuurde filter.
     * <strong>Let op:</strong> het kan zijn dat niet alle inkoopregels van een bepaalde order worden opgehaald, doordat de uitvoer wordt gelimiteerd via de Skip- en TakeRecords.
     *
     * @param array{
     *     SkipRecords?: int|null,
     *     TakeRecords?: int|null,
     *     ProductId?: int|null,
     *     ProductCode?: string|null,
     *     BuyOrderStatusId?: int|null,
     *     IsDropShipment?: bool|null,
     *     OrderId?: int|null,
     *     BuyOrderId?: int|null,
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
     * Haal inkooporders op o.b.v. het meegestuurde filter. De hoeveelheid inkooporders wordt gelimiteerd aan de hand van opgegeven SkipRecords en TakeRecords.
     * TakeRecords wordt gelimiteerd op 10.000.
     *
     * @param array{
     *     SkipRecords?: int|null,
     *     TakeRecords?: int|null,
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
     * @return \Generator<array-key, BuyOrderGetInfo>
     *
     * @throws Logic4ApiException
     */
    public function getBuyOrders(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1.1/BuyOrders/GetBuyOrders', $parameters);

        foreach ($iterator as $record) {
            yield BuyOrderGetInfo::make($record);
        }
    }
}
