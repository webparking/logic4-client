<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V10;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfOrderShipment;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseOfboolean;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseOfOrderShipment;

class ShipmentRequest extends Request
{
    /**
     * Verzending toevoegen aan een order of factuur. De nieuw aangemaakte verzending wordt teruggegeven als response.
     *
     * @param array{
     *     DateTimeAdded?: string|null,
     *     OrderId?: int,
     *     ShipperId?: int,
     *     Barcode?: string|null,
     *     TrackTraceUrl?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addShipmentForInvoiceOrOrder(
        array $parameters = [],
    ): Logic4ResponseOfboolean {
        return Logic4ResponseOfboolean::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Shipments/AddShipmentForInvoiceOrOrder', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verzending toevoegen aan een order of factuur. De nieuw aangemaakte verzending wordt teruggegeven als response.
     * Indien de optie 'SendEmail' 'True' is word deze shipment opgepakt door T&amp;T verwerk service in de desktop applicatie
     * voor het verzenden van een email.
     *
     * @param array{
     *     DateTimeAdded?: string|null,
     *     SendEmail?: bool,
     *     OrderId?: int,
     *     ShipperId?: int,
     *     Barcode?: string|null,
     *     TrackTraceUrl?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addShipmentForInvoiceOrOrderWithEmailing(
        array $parameters = [],
    ): Logic4ResponseOfOrderShipment {
        return Logic4ResponseOfOrderShipment::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Shipments/AddShipmentForInvoiceOrOrderWithEmailing', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verzending verwijderen voor een order of factuur, specificeer met het ID van de verzending. De verzending moet bestaan.
     *
     * @throws Logic4ApiException
     */
    public function deleteShipmentForInvoiceOrOrder(
        int $id,
    ): Logic4ResponseOfboolean {
        return Logic4ResponseOfboolean::make(
            $this->buildResponse(
                $this->getClient()->delete('/v1/Shipments/DeleteShipmentForInvoiceOrOrder', ['query' => ['id' => $id]]),
            )
        );
    }

    /**
     * Verzendingen van een order of factuur ophalen voor het opgestuurde nummer.
     *
     * @throws Logic4ApiException
     */
    public function getShipmentsForInvoiceOrOrder(
        int $value,
    ): Logic4ResponseListOfOrderShipment {
        return Logic4ResponseListOfOrderShipment::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Shipments/GetShipmentsForInvoiceOrOrder', ['json' => $value]),
            )
        );
    }
}
