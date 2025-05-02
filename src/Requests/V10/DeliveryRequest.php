<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V10;

use Webparking\Logic4Client\Data\V10\SalesOrderDelivery;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V10\SalesOrderDeliveryRowLogic4ResponseList;

class DeliveryRequest extends Request
{
    /**
     * Maak een nieuwe uitlevering aan o.b.v. opgestuurde orderregels. Het systeem bepaalt automatisch vanaf welke voorraadlocatie de voorraad afgeboekt wordt.
     *
     * @param array{
     *     DeliveryRows?: array<array{RowId?: integer, AmountToDeliver?: number}>|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function createDeliveryForOrderRows(
        array $parameters = [],
    ): SalesOrderDeliveryRowLogic4ResponseList {
        return SalesOrderDeliveryRowLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Delivery/CreateDeliveryForOrderRows', ['json' => $parameters]),
            )
        );
    }

    /**
     * @param array{
     *     DateFrom?: string|null,
     *     DateTo?: string|null,
     *     OrderId?: integer|null,
     *     DebtorId?: integer|null,
     *     OrderShipperMethodeId?: integer|null,
     *     OrderStatusId?: integer|null,
     *     BranchId?: integer|null,
     *     WebsiteDomainId?: integer|null,
     *     Skip?: integer|null,
     *     Take?: integer|null,
     * } $parameters
     *
     * @return \Generator<array-key, SalesOrderDelivery>
     *
     * @throws Logic4ApiException
     *
     * @deprecated Let op! Versie 1.0 is verouderd. Gebruik versie v2.0. - Zoeken op verkooporder uitleveringen.
     */
    public function getDeliveries(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1/Delivery/GetDeliveries', $parameters, 'Take', 'Skip');

        foreach ($iterator as $record) {
            yield SalesOrderDelivery::make($record);
        }
    }
}
