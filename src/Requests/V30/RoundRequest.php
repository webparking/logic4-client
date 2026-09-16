<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V30;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V30\GetRound;
use Webparking\Logic4Client\Responses\V30\GetRoundOrder;
use Webparking\Logic4Client\Responses\V30\TypeRoundOrderStatus;
use Webparking\Logic4Client\Responses\V30\TypeRoundStatus;
use Webparking\Logic4Client\Responses\V30\Vehicle;

class RoundRequest extends Request
{
    /**
     * Voeg een rit toe aan de database. Het ID van de zojuist aangemaakte rit wordt als response teruggegeven.
     *
     * @param array{
     *     TypeId?: int,
     *     Description?: string|null,
     *     Memo?: string|null,
     *     DateTimePlanned?: string|null,
     *     VehicleId?: int|null,
     *     DriverId?: int|null,
     *     CoDriverId?: int|null,
     *     StatusId?: int,
     *     HideInSystem?: bool,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addRound(array $parameters = []): int
    {
        return $this->buildResponse(
            $this->getClient()->post('/v3/Round/AddRound', ['json' => $parameters]),
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
     *     RoundId?: int,
     *     Remarks?: string|null,
     *     StatusId?: int,
     *     Sorting?: int,
     *     EstimatedArrivalDateTime?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addRoundOrder(array $parameters = []): int
    {
        return $this->buildResponse(
            $this->getClient()->post('/v3/Round/AddRoundOrder', ['json' => $parameters]),
        );
    }

    /**
     * Verwijder een rit. De response geeft 'true' terug als de actie is geslaagd.
     *
     * @throws Logic4ApiException
     */
    public function deleteRound(int $roundId): void
    {
        $this->getClient()->delete('/v3/Round/DeleteRound', ['query' => ['roundId' => $roundId]]);
    }

    /**
     * Verwijder één rit regel. Hierbij wordt ook de status historie van deze regel verwijderd.
     *
     * @throws Logic4ApiException
     */
    public function deleteRoundOrder(int $roundOrderId): void
    {
        $this->getClient()->delete('/v3/Round/DeleteRoundOrder', ['query' => ['roundOrderId' => $roundOrderId]]);
    }

    /**
     * Haal rit regels op voor een bepaalde rit. Het is verplicht om een rit Id op te geven.
     * Het maximaal aantal regels dat wordt teruggegeven is 1000.
     * Om meer regels op te halen dien je gebruik te maken van de skip/take filtering.
     *
     * @param array{
     *     SkipRecords?: int|null,
     *     TakeRecords?: int|null,
     *     RoundId?: int,
     *     StatusId?: int|null,
     * } $parameters
     *
     * @return array<array-key, GetRoundOrder>
     *
     * @throws Logic4ApiException
     */
    public function getRoundOrders(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => GetRoundOrder::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Round/GetRoundOrders', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Verkrijg een collectie van statussen die gebruikt worden voor orders in ritten.
     * Bijv. "Wacht op goedkeuring".
     *
     * @return array<array-key, TypeRoundOrderStatus>
     *
     * @throws Logic4ApiException
     */
    public function getRoundOrderStatuses(): array
    {
        return array_map(
            static fn (array $data) => TypeRoundOrderStatus::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/Round/GetRoundOrderStatuses'),
            ),
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
     *     ItsIds?: array<int>,
     *     OrderIds?: array<int>,
     * } $parameters
     *
     * @return array<array-key, GetRound>
     *
     * @throws Logic4ApiException
     */
    public function getRounds(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => GetRound::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Round/GetRounds', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Verkrijg een collectie van statussen die gebruikt worden voor ritten.
     * Bijv. "80% gevuld".
     *
     * @return array<array-key, TypeRoundStatus>
     *
     * @throws Logic4ApiException
     */
    public function getRoundStatuses(): array
    {
        return array_map(
            static fn (array $data) => TypeRoundStatus::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/Round/GetRoundStatuses'),
            ),
        );
    }

    /**
     * Verkrijg een collectie van voertuigen die ingezet kunnen worden bij ritten.
     *
     * @return array<array-key, Vehicle>
     *
     * @throws Logic4ApiException
     */
    public function getVehicles(): array
    {
        return array_map(
            static fn (array $data) => Vehicle::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/Round/GetVehicles'),
            ),
        );
    }

    /**
     * Update gegevens van een rit.
     * Wanneer de operatie succesvol is zal het response "True" zijn.
     * Let op, je moet het gehele object vullen. Lege waardes worden ook overgenomen.
     *
     * @param array{
     *     Id?: int,
     *     TypeId?: int,
     *     Description?: string|null,
     *     Memo?: string|null,
     *     DateTimePlanned?: string|null,
     *     VehicleId?: int|null,
     *     DriverId?: int|null,
     *     CoDriverId?: int|null,
     *     StatusId?: int,
     *     HideInSystem?: bool,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function updateRound(array $parameters = []): void
    {
        $this->getClient()->post('/v3/Round/UpdateRound', ['json' => $parameters]);
    }

    /**
     * Update de gegevens van een rit regel.
     * Wanneer de operatie succesvol is zal het response "True" zijn.
     * Let op, je moet het gehele object vullen. Lege waardes worden ook overgenomen.
     *
     * @param array{
     *     Id?: int,
     *     Remarks?: string|null,
     *     StatusId?: int,
     *     Sorting?: int,
     *     EstimatedArrivalDateTime?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function updateRoundOrder(array $parameters = []): void
    {
        $this->getClient()->post('/v3/Round/UpdateRoundOrder', ['json' => $parameters]);
    }
}
