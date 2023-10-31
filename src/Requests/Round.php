<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests;

use Webparking\Logic4Client\Data\GetRound;
use Webparking\Logic4Client\Data\GetRoundOrder;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\PaginatedResponse;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\BooleanLogic4Response;
use Webparking\Logic4Client\Responses\Int32Logic4Response;
use Webparking\Logic4Client\Responses\TypeRoundOrderStatusLogic4ResponseList;
use Webparking\Logic4Client\Responses\TypeRoundStatusLogic4ResponseList;
use Webparking\Logic4Client\Responses\VehicleLogic4ResponseList;

class Round extends Request
{
    /**
     * Voeg een rit toe aan de database. Het ID van de zojuist aangemaakte rit wordt als response teruggegeven.
     *
     * @param array{
     *     TypeId?: integer,
     *     Description?: string,
     *     Memo?: string,
     *     DateTimePlanned?: string,
     *     VehicleId?: integer,
     *     DriverId?: integer,
     *     CoDriverId?: integer,
     *     StatusId?: integer,
     *     HideInSystem?: boolean,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addRound(array $parameters = []): Int32Logic4Response
    {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Round/AddRound', ['json' => $parameters]),
            )
        );
    }

    /**
     * Een rit bestaat uit regels die gekoppeld zijn aan verkooporders of aan ITS opdrachten.
     * Hiermee kan je één regel toevoegen aan een rit.
     * Het voertuig bepaalt of je Orders, of ITS of beide mag toevoegen.
     *
     * @param array{
     *     OrderId?: integer,
     *     ITSIssueId?: integer,
     *     RoundId?: integer,
     *     Remarks?: string,
     *     StatusId?: integer,
     *     Sorting?: integer,
     *     EstimatedArrivalDateTime?: string,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addRoundOrder(array $parameters = []): Int32Logic4Response
    {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Round/AddRoundOrder', ['json' => $parameters]),
            )
        );
    }

    /**
     * Haal rit regels op voor een bepaalde rit. Het is verplicht om een rit Id op te geven.
     * Het maximaal aantal regels dat wordt teruggegeven is 1000.
     * Om meer regels op te halen dien je gebruik te maken van de skip/take filtering.
     *
     * @param array{
     *     SkipRecords?: integer,
     *     TakeRecords?: integer,
     *     RoundId?: integer,
     *     StatusId?: integer,
     * } $parameters
     *
     * @return PaginatedResponse<GetRoundOrder>
     *
     * @throws Logic4ApiException
     */
    public function getRoundOrders(array $parameters = []): PaginatedResponse
    {
        return new PaginatedResponse(
            $this->paginateRecords('/v1/Round/GetRoundOrders', $parameters),
            GetRoundOrder::class,
        );
    }

    /**
     * Verkrijg een collectie van statussen die gebruikt worden voor orders in ritten.
     * Bijv. "Wacht op goedkeuring".
     *
     * @throws Logic4ApiException
     */
    public function getRoundOrderStatuses(): TypeRoundOrderStatusLogic4ResponseList
    {
        return TypeRoundOrderStatusLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Round/GetRoundOrderStatuses'),
            )
        );
    }

    /**
     * Verkrijg een collectie van ritten (maximaal 1000 records).
     *
     * @param array{
     *     SkipRecords?: integer,
     *     TakeRecords?: integer,
     *     DateTimeCreatedFrom?: string,
     *     DateTimeCreatedTo?: string,
     *     TypeId?: integer,
     *     StatusId?: integer,
     *     VehicleId?: integer,
     *     ItsIds?: array<integer>,
     *     OrderIds?: array<integer>,
     * } $parameters
     *
     * @return PaginatedResponse<GetRound>
     *
     * @throws Logic4ApiException
     */
    public function getRounds(array $parameters = []): PaginatedResponse
    {
        return new PaginatedResponse(
            $this->paginateRecords('/v1/Round/GetRounds', $parameters),
            GetRound::class,
        );
    }

    /**
     * Verkrijg een collectie van statussen die gebruikt worden voor ritten.
     * Bijv. "80% gevuld".
     *
     * @throws Logic4ApiException
     */
    public function getRoundStatuses(): TypeRoundStatusLogic4ResponseList
    {
        return TypeRoundStatusLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Round/GetRoundStatuses'),
            )
        );
    }

    /**
     * Verkrijg een collectie van voertuigen die ingezet kunnen worden bij ritten.
     *
     * @throws Logic4ApiException
     */
    public function getVehicles(): VehicleLogic4ResponseList
    {
        return VehicleLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Round/GetVehicles'),
            )
        );
    }

    /**
     * Update gegevens van een rit.
     * Wanneer de operatie succesvol is zal het response "True" zijn.
     * Let op, je moet het gehele object vullen. Lege waardes worden ook overgenomen.
     *
     * @param array{
     *     Id?: integer,
     *     TypeId?: integer,
     *     Description?: string,
     *     Memo?: string,
     *     DateTimePlanned?: string,
     *     VehicleId?: integer,
     *     DriverId?: integer,
     *     CoDriverId?: integer,
     *     StatusId?: integer,
     *     HideInSystem?: boolean,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function updateRound(array $parameters = []): BooleanLogic4Response
    {
        return BooleanLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Round/UpdateRound', ['json' => $parameters]),
            )
        );
    }

    /**
     * Update de gegevens van een rit regel.
     * Wanneer de operatie succesvol is zal het response "True" zijn.
     * Let op, je moet het gehele object vullen. Lege waardes worden ook overgenomen.
     *
     * @param array{
     *     Id?: integer,
     *     Remarks?: string,
     *     StatusId?: integer,
     *     Sorting?: integer,
     *     EstimatedArrivalDateTime?: string,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function updateRoundOrder(array $parameters = []): BooleanLogic4Response
    {
        return BooleanLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Round/UpdateRoundOrder', ['json' => $parameters]),
            )
        );
    }
}
