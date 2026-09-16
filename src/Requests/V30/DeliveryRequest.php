<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V30;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V30\SalesOrderDelivery;
use Webparking\Logic4Client\Responses\V30\SalesOrderDeliveryRow;

class DeliveryRequest extends Request
{
    /**
     * Maak een nieuwe uitlevering aan o.b.v. opgestuurde orderregels. Het systeem bepaalt automatisch vanaf welke voorraadlocatie de voorraad afgeboekt wordt.
     *
     * @param array{
     *     DeliveryRows?: array<array{RowId?: int, AmountToDeliver?: number}>,
     * } $parameters
     *
     * @return array<array-key, SalesOrderDeliveryRow>
     *
     * @throws Logic4ApiException
     */
    public function createDeliveryForOrderRows(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => SalesOrderDeliveryRow::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Delivery/CreateDeliveryForOrderRows', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Zoeken op verkooporder uitleveringen.
     *
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
     * @return array<array-key, SalesOrderDelivery>
     *
     * @throws Logic4ApiException
     */
    public function getDeliveries(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => SalesOrderDelivery::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Delivery/GetDeliveries', ['json' => $parameters]),
            ),
        );
    }
}
