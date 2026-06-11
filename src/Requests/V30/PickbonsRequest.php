<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V30;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V30\OrderHeadPickbon;
use Webparking\Logic4Client\Responses\V30\OrderHeadPickbonRow;
use Webparking\Logic4Client\Responses\V30\PickbonSoftBlocked;
use Webparking\Logic4Client\Responses\V30\WarehouseZone;

class PickbonsRequest extends Request
{
    /**
     * Maak nieuwe pickbon(nen) aan voor een gehele order op het moment dat de 'nog te leveren' regels volledig gepickt kunnen worden.
     *
     * @param array{
     *     OrderId?: int,
     *     UseNewWorkflow?: bool,
     * } $parameters
     *
     * @return array<array-key, int>
     *
     * @throws Logic4ApiException
     */
    public function createCompletePickbonForOrder(array $parameters = []): array
    {
        return $this->buildResponse(
            $this->getClient()->post('/v3/Pickbons/CreateCompletePickbonForOrder', ['json' => $parameters]),
        );
    }

    /**
     * Maak nieuwe pickbon(nen) aan voor de nu te picken leveren orderregels.
     *
     * @return array<array-key, int>
     *
     * @throws Logic4ApiException
     */
    public function createPickbonForOrder(int $value): array
    {
        return $this->buildResponse(
            $this->getClient()->post('/v3/Pickbons/CreatePickbonForOrder', ['json' => $value]),
        );
    }

    /**
     * Controleer of de pickbon soft-blocked is en zo ja, door wie en wanneer?
     *
     * @throws Logic4ApiException
     */
    public function getIsPickbonSoftBlocked(int $value): PickbonSoftBlocked
    {
        return PickbonSoftBlocked::make(
            $this->buildResponse(
                $this->getClient()->post('/v3/Pickbons/GetIsPickbonSoftBlocked', ['json' => $value]),
            )
        );
    }

    /**
     * Verkrijg simpele pickbon rijen op basis van pickbonnen.
     *
     * @param array<int> $parameters
     *
     * @return array<array-key, OrderHeadPickbonRow>
     *
     * @throws Logic4ApiException
     */
    public function getOrderHeadPickbonRows(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => OrderHeadPickbonRow::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Pickbons/GetOrderHeadPickbonRows', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Verkrijg pickbonnen op basis van het meegegeven filter.
     *
     * @param array{
     *     SkipRecords?: int,
     *     TakeRecords?: int,
     *     OnlyUnprocessedItems?: bool,
     *     OrderCreatedFrom?: string|null,
     *     WarehouseZoneId?: int|null,
     *     WarehouseId?: int|null,
     *     PickBonId?: int|null,
     * } $parameters
     *
     * @return array<array-key, OrderHeadPickbon>
     *
     * @throws Logic4ApiException
     */
    public function getOrderHeadPickbons(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => OrderHeadPickbon::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Pickbons/GetOrderHeadPickbons', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Verkrijg alle magazijnzones.
     *
     * @return array<array-key, WarehouseZone>
     *
     * @throws Logic4ApiException
     */
    public function getWarehouseZones(): array
    {
        return array_map(
            static fn (array $data) => WarehouseZone::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/Pickbons/GetWarehouseZones'),
            ),
        );
    }

    /**
     * Soft-block pickbonnen.
     *
     * @param array<int> $parameters
     *
     * @throws Logic4ApiException
     */
    public function postSoftBlockPickbons(array $parameters = []): void
    {
        $this->getClient()->post('/v3/Pickbons/PostSoftBlockPickbons', ['json' => $parameters]);
    }

    /**
     * Verwerk pickbonnen.
     *
     * @param array<array{
     *     AmountOfColli?: int,
     *     Corrections?: array<array{}>,
     *     Mutations?: array<array{OrderHeadPickbonRowId?: int, WarehouseStockLocationId?: int, MutationAmount?: number}>,
     *     OrderHeadPickbonId?: int,
     *     InterimLocationId?: int|null,
     *     Remarks?: string|null,
     * }> $parameters
     *
     * @throws Logic4ApiException
     */
    public function processPickbons(array $parameters = []): string
    {
        return $this->buildResponse(
            $this->getClient()->post('/v3/Pickbons/ProcessPickbons', ['json' => $parameters]),
        );
    }
}
