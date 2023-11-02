<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\SalesOrderDeliveryLogic4ResponseList;
use Webparking\Logic4Client\Responses\SalesOrderDeliveryRowLogic4ResponseList;

class DeliveryRequest extends Request
{
    /**
     * Maak een nieuwe uitlevering aan o.b.v. opgestuurde orderregels. Het systeem bepaalt automatisch vanaf welke voorraadlocatie de voorraad afgeboekt wordt.
     *
     * @param array{
     *     DeliveryRows?: array<mixed>|null,
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
     * @throws Logic4ApiException
     */
    public function getDeliveries(
        array $parameters = [],
    ): SalesOrderDeliveryLogic4ResponseList {
        return SalesOrderDeliveryLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Delivery/GetDeliveries', ['json' => $parameters]),
            )
        );
    }
}
