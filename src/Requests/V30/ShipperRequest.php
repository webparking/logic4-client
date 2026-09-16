<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V30;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V30\DeliveryOption;
use Webparking\Logic4Client\Responses\V30\ShipperType;
use Webparking\Logic4Client\Responses\V30\ShippingMethod;

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
     * @return array<array-key, DeliveryOption>
     *
     * @throws Logic4ApiException
     */
    public function getDeliveryOptions(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => DeliveryOption::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Shippers/GetDeliveryOptions', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Verkrijg alle verzendmethode types.
     *
     * @return array<array-key, ShipperType>
     *
     * @throws Logic4ApiException
     */
    public function getShipperTypes(): array
    {
        return array_map(
            static fn (array $data) => ShipperType::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/Shippers/GetShipperTypes'),
            ),
        );
    }

    /**
     * Verkrijg alle verzendmethodes.
     *
     * @return array<array-key, ShippingMethod>
     *
     * @throws Logic4ApiException
     */
    public function getShippingMethods(): array
    {
        return array_map(
            static fn (array $data) => ShippingMethod::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/Shippers/GetShippingMethods'),
            ),
        );
    }
}
