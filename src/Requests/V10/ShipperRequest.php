<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V10;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\DeliveryOptionLogic4ResponseList;
use Webparking\Logic4Client\Responses\ShipperTypeLogic4ResponseList;
use Webparking\Logic4Client\Responses\ShippingMethodLogic4ResponseList;

class ShipperRequest extends Request
{
    /**
     * Verkrijg alle afleveropties o.b.v een filter.
     *
     * @param array{
     *     IsPickupLocation?: boolean|null,
     *     ShipperTypeId?: integer|null,
     *     ExternalTypeValue?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getDeliveryOptions(
        array $parameters = [],
    ): DeliveryOptionLogic4ResponseList {
        return DeliveryOptionLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Shippers/GetDeliveryOptions', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg alle verzendmethode types.
     *
     * @throws Logic4ApiException
     */
    public function getShipperTypes(): ShipperTypeLogic4ResponseList
    {
        return ShipperTypeLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Shippers/GetShipperTypes'),
            )
        );
    }

    /**
     * Verkrijg alle verzendmethodes.
     *
     * @throws Logic4ApiException
     */
    public function getShippingMethods(): ShippingMethodLogic4ResponseList
    {
        return ShippingMethodLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Shippers/GetShippingMethods'),
            )
        );
    }
}
