<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\SalesOrderDeliveryLogic4ResponseList;
use Webparking\Logic4Client\Responses\SalesOrderDeliveryRowLogic4ResponseList;

class Delivery extends Request
{
    /**
     * Maak een nieuwe uitlevering aan o.b.v. opgestuurde orderregels. Het systeem bepaalt automatisch vanaf welke voorraadlocatie de voorraad afgeboekt wordt.
     *
     * @param array{
     *     DeliveryRows?: array<mixed>,
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
     *     DateFrom?: string,
     *     DateTo?: string,
     *     OrderId?: integer,
     *     DebtorId?: integer,
     *     OrderShipperMethodeId?: integer,
     *     OrderStatusId?: integer,
     *     BranchId?: integer,
     *     WebsiteDomainId?: integer,
     *     Skip?: integer,
     *     Take?: integer,
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
