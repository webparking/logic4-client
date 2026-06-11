<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V10;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfDeliveryOption;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfShipperType;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfShippingMethod;

class ShipperRequest extends Request
{
    /**
     * Verkrijg alle afleveropties o.b.v een filter.
     *
     * @param array{
     *     IsPickupLocation?: bool|null,
     *     ShipperTypeId?: int|null,
     *     ExternalTypeValue?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getDeliveryOptions(
        array $parameters = [],
    ): Logic4ResponseListOfDeliveryOption {
        return Logic4ResponseListOfDeliveryOption::make(
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
    public function getShipperTypes(): Logic4ResponseListOfShipperType
    {
        return Logic4ResponseListOfShipperType::make(
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
    public function getShippingMethods(): Logic4ResponseListOfShippingMethod
    {
        return Logic4ResponseListOfShippingMethod::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Shippers/GetShippingMethods'),
            )
        );
    }
}
