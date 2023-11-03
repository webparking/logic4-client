<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\BooleanLogic4Response;
use Webparking\Logic4Client\Responses\OrderShipmentLogic4Response;
use Webparking\Logic4Client\Responses\OrderShipmentLogic4ResponseList;

class ShipmentRequest extends Request
{
    /**
     * Verzending toevoegen aan een order of factuur. De nieuw aangemaakte verzending wordt teruggegeven als response.
     *
     * @param array{
     *     DateTimeAdded?: string|null,
     *     OrderId?: integer|null,
     *     ShipperId?: integer|null,
     *     Barcode?: string|null,
     *     TrackTraceUrl?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addShipmentForInvoiceOrOrder(
        array $parameters = [],
    ): BooleanLogic4Response {
        return BooleanLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Shipments/AddShipmentForInvoiceOrOrder', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verzending toevoegen aan een order of factuur. De nieuw aangemaakte verzending wordt teruggegeven als response.
     * Indien de optie 'SendEmail' 'True' is word deze shipment opgepakt door T&T verwerk service in de desktop applicatie
     * voor het verzenden van een email.
     *
     * @param array{
     *     DateTimeAdded?: string|null,
     *     SendEmail?: boolean|null,
     *     OrderId?: integer|null,
     *     ShipperId?: integer|null,
     *     Barcode?: string|null,
     *     TrackTraceUrl?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addShipmentForInvoiceOrOrderWithEmailing(
        array $parameters = [],
    ): OrderShipmentLogic4Response {
        return OrderShipmentLogic4Response::make(
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
    public function deleteShipmentForInvoiceOrOrder(): BooleanLogic4Response
    {
        return BooleanLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->delete('/v1/Shipments/DeleteShipmentForInvoiceOrOrder'),
            )
        );
    }

    /**
     * Verzendingen van een order of factuur ophalen voor het opgestuurde nummer.
     *
     * @throws Logic4ApiException
     */
    public function getShipmentsForInvoiceOrOrder(): OrderShipmentLogic4ResponseList
    {
        return OrderShipmentLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Shipments/GetShipmentsForInvoiceOrOrder'),
            )
        );
    }
}
