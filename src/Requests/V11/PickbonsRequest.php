<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V11;

use Webparking\Logic4Client\Data\V11\OrderHeadPickbon;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V11\Int32Logic4ResponseList;
use Webparking\Logic4Client\Responses\V11\StringLogic4Response;

class PickbonsRequest extends Request
{
    /**
     * @param array{
     *     OrderId?: integer|null,
     *     UseNewWorkflow?: boolean|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function createCompletePickbonForOrder(
        array $parameters = [],
    ): Int32Logic4ResponseList {
        return Int32Logic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.1/Pickbons/CreateCompletePickbonForOrder', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg pickbonnen op basis van het meegegeven filter.
     *
     * @param array{
     *     SkipRecords?: integer|null,
     *     TakeRecords?: integer|null,
     *     OnlyUnprocessedItems?: boolean|null,
     *     OrderCreatedFrom?: string|null,
     *     WarehouseZoneId?: integer|null,
     *     WarehouseId?: integer|null,
     *     PickBonId?: integer|null,
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
    ): StringLogic4Response {
        return StringLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.1/Pickbons/PostSoftBlockPickbons', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verwerk meerdere pickbonnen.
     *
     * @param array<array{
     *     AmountOfColli?: integer|null,
     *     Corrections?: array<array{OrderRowId?: integer, OrderHeadPickbonId?: integer, Qty?: number}>|null,
     *     Mutations?: array<array{OrderHeadPickbonRowId?: integer, WarehouseStockLocationId?: integer, MutationAmount?: number}>|null,
     *     OrderHeadPickbonId?: integer|null,
     *     InterimLocationId?: integer|null,
     *     Remarks?: string|null,
     * }> $parameters
     *
     * @throws Logic4ApiException
     */
    public function processPickbons(array $parameters = []): StringLogic4Response
    {
        return StringLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.1/Pickbons/ProcessPickbons', ['json' => $parameters]),
            )
        );
    }
}
