<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V20;

use Webparking\Logic4Client\Data\V20\SalesOrderDelivery;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;

class DeliveryRequest extends Request
{
    /**
     * @param array{
     *     DateTimeFrom?: string|null,
     *     DateTimeTo?: string|null,
     *     OrderId?: int|null,
     *     DebtorId?: int|null,
     *     ShippingMethodId?: int|null,
     *     OrderStatusId?: int|null,
     *     BranchId?: int|null,
     *     WebsiteDomainId?: int|null,
     *     SkipRecords?: int,
     *     TakeRecords?: int,
     *     ShowAPIMovements?: bool,
     * } $parameters
     *
     * @return \Generator<array-key, SalesOrderDelivery>
     *
     * @throws Logic4ApiException
     */
    public function getDeliveries(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v2/Delivery/GetDeliveries', $parameters);

        foreach ($iterator as $record) {
            yield SalesOrderDelivery::make($record);
        }
    }
}
