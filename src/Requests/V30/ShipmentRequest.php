<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V30;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V30\OrderShipment;

class ShipmentRequest extends Request
{
    /**
     * Verzending toevoegen aan een uitleveringen. De nieuw aangemaakte verzending wordt teruggegeven als response.
     *
     * @param array{
     *     DeliveryId?: int,
     *     ShipperId?: int,
     *     Barcode?: string|null,
     *     TrackTraceUrl?: string|null,
     *     DateTimeAdded?: string|null,
     *     SendEmail?: bool|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addShipmentForDelivery(array $parameters = []): int
    {
        return $this->buildResponse(
            $this->getClient()->post('/v3/Shipments/AddShipmentForDelivery', ['json' => $parameters]),
        );
    }

    /**
     * Verzending toevoegen aan een order of factuur. De nieuw aangemaakte verzending wordt teruggegeven als response.
     *
     * @param array{
     *     DateTimeAdded?: string|null,
     *     SendEmail?: bool|null,
     *     OrderId?: int,
     *     ShipperId?: int,
     *     Barcode?: string|null,
     *     TrackTraceUrl?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addShipmentForInvoiceOrOrder(array $parameters = []): int
    {
        return $this->buildResponse(
            $this->getClient()->post('/v3/Shipments/AddShipmentForInvoiceOrOrder', ['json' => $parameters]),
        );
    }

    /**
     * Verzending verwijderen voor een order of factuur, specificeer met het ID van de verzending. De verzending moet bestaan.
     *
     * @throws Logic4ApiException
     */
    public function deleteShipmentForInvoiceOrOrder(int $id): void
    {
        $this->getClient()->delete('/v3/Shipments/DeleteShipmentForInvoiceOrOrder', ['query' => ['id' => $id]]);
    }

    /**
     * Verzendingen van een order of factuur ophalen voor het opgestuurde nummer.
     *
     * @return array<array-key, OrderShipment>
     *
     * @throws Logic4ApiException
     */
    public function getShipmentsForInvoiceOrOrder(int $value): array
    {
        return array_map(
            static fn (array $data) => OrderShipment::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Shipments/GetShipmentsForInvoiceOrOrder', ['json' => $value]),
            ),
        );
    }
}
