<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V10;

use Webparking\Logic4Client\Data\V10\GetRound;
use Webparking\Logic4Client\Data\V10\GetRoundOrder;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V10\BooleanLogic4Response;
use Webparking\Logic4Client\Responses\V10\Int32Logic4Response;
use Webparking\Logic4Client\Responses\V10\TypeRoundOrderStatusLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\TypeRoundStatusLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\VehicleLogic4ResponseList;

class RoundRequest extends Request
{
    /**
     * Voeg een rit toe aan de database. Het ID van de zojuist aangemaakte rit wordt als response teruggegeven.
     *
     * @param array{
     *     TypeId?: int|null,
     *     Description?: string|null,
     *     Memo?: string|null,
     *     DateTimePlanned?: string|null,
     *     VehicleId?: int|null,
     *     DriverId?: int|null,
     *     CoDriverId?: int|null,
     *     StatusId?: int|null,
     *     HideInSystem?: bool|null,
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
     *     OrderId?: int|null,
     *     ITSIssueId?: int|null,
     *     RoundId?: int|null,
     *     Remarks?: string|null,
     *     StatusId?: int|null,
     *     Sorting?: int|null,
     *     EstimatedArrivalDateTime?: string|null,
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
     * Verwijder een rit. De response geeft 'true' terug als de actie is geslaagd.
     *
     * @throws Logic4ApiException
     */
    public function deleteRound(int $roundId): BooleanLogic4Response
    {
        return BooleanLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->delete('/v1/Round/DeleteRound', ['query' => ['roundId' => $roundId]]),
            )
        );
    }

    /**
     * Verwijder één rit regel. Hierbij wordt ook de status historie van deze regel verwijderd.
     *
     * @throws Logic4ApiException
     */
    public function deleteRoundOrder(int $roundOrderId): BooleanLogic4Response
    {
        return BooleanLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->delete('/v1/Round/DeleteRoundOrder', ['query' => ['roundOrderId' => $roundOrderId]]),
            )
        );
    }

    /**
     * Haal rit regels op voor een bepaalde rit. Het is verplicht om een rit Id op te geven.
     * Het maximaal aantal regels dat wordt teruggegeven is 1000.
     * Om meer regels op te halen dien je gebruik te maken van de skip/take filtering.
     *
     * @param array{
     *     SkipRecords?: int|null,
     *     TakeRecords?: int|null,
     *     RoundId?: int|null,
     *     StatusId?: int|null,
     * } $parameters
     *
     * @return \Generator<array-key, GetRoundOrder>
     *
     * @throws Logic4ApiException
     */
    public function getRoundOrders(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1/Round/GetRoundOrders', $parameters);

        foreach ($iterator as $record) {
            yield GetRoundOrder::make($record);
        }
    }

    /**
     * Verkrijg een collectie van statussen die gebruikt worden voor orders in ritten.
     * Bijv. "Wacht op goedkeuring".
     *
     * @throws Logic4ApiException
     */
    public function getRoundOrderStatuses(
    ): TypeRoundOrderStatusLogic4ResponseList {
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
     *     SkipRecords?: int|null,
     *     TakeRecords?: int|null,
     *     DateTimeCreatedFrom?: string|null,
     *     DateTimeCreatedTo?: string|null,
     *     TypeId?: int|null,
     *     StatusId?: int|null,
     *     VehicleId?: int|null,
     *     ItsIds?: array<int>|null,
     *     OrderIds?: array<int>|null,
     * } $parameters
     *
     * @return \Generator<array-key, GetRound>
     *
     * @throws Logic4ApiException
     */
    public function getRounds(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1/Round/GetRounds', $parameters);

        foreach ($iterator as $record) {
            yield GetRound::make($record);
        }
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
     *     Id?: int|null,
     *     TypeId?: int|null,
     *     Description?: string|null,
     *     Memo?: string|null,
     *     DateTimePlanned?: string|null,
     *     VehicleId?: int|null,
     *     DriverId?: int|null,
     *     CoDriverId?: int|null,
     *     StatusId?: int|null,
     *     HideInSystem?: bool|null,
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
     *     Id?: int|null,
     *     Remarks?: string|null,
     *     StatusId?: int|null,
     *     Sorting?: int|null,
     *     EstimatedArrivalDateTime?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function updateRoundOrder(
        array $parameters = [],
    ): BooleanLogic4Response {
        return BooleanLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Round/UpdateRoundOrder', ['json' => $parameters]),
            )
        );
    }
}
