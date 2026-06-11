<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V11;

use Webparking\Logic4Client\Data\V11\OrderHeadPickbon;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V11\Logic4ResponseListOfint;
use Webparking\Logic4Client\Responses\V11\Logic4ResponseOfstring;

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
     * @throws Logic4ApiException
     */
    public function createCompletePickbonForOrder(
        array $parameters = [],
    ): Logic4ResponseListOfint {
        return Logic4ResponseListOfint::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.1/Pickbons/CreateCompletePickbonForOrder', ['json' => $parameters]),
            )
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
     * @return \Generator<array-key, OrderHeadPickbon>
     *
     * @throws Logic4ApiException
     */
    public function getOrderHeadPickbons(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1.1/Pickbons/GetOrderHeadPickbons', $parameters);

        foreach ($iterator as $record) {
            yield OrderHeadPickbon::make($record);
        }
    }

    /**
     * Soft-block meerdere pickbonnen.
     *
     * @param array<int> $parameters
     *
     * @throws Logic4ApiException
     */
    public function postSoftBlockPickbons(
        array $parameters = [],
    ): Logic4ResponseOfstring {
        return Logic4ResponseOfstring::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.1/Pickbons/PostSoftBlockPickbons', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verwerk meerdere pickbonnen.
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
    public function processPickbons(
        array $parameters = [],
    ): Logic4ResponseOfstring {
        return Logic4ResponseOfstring::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.1/Pickbons/ProcessPickbons', ['json' => $parameters]),
            )
        );
    }
}
