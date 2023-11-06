<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests;

use Webparking\Logic4Client\Data\OrderHeadPickbon;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\Int32Logic4ResponseList;
use Webparking\Logic4Client\Responses\OrderHeadPickbonRowLogic4ResponseList;
use Webparking\Logic4Client\Responses\PickbonSoftBlockedLogic4Response;
use Webparking\Logic4Client\Responses\PickbonSoftBlockedLogic4ResponseList;
use Webparking\Logic4Client\Responses\StringLogic4Response;
use Webparking\Logic4Client\Responses\WarehouseZoneLogic4ResponseList;

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
     * Maak nieuwe pickbon(nen) aan voor de nu te picken leveren orderregels.
     *
     * @throws Logic4ApiException
     */
    public function createPickbonForOrder(int $value): Int32Logic4ResponseList
    {
        return Int32Logic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Pickbons/CreatePickbonForOrder', ['json' => $value]),
            )
        );
    }

    /**
     * Controleer of de pickbon soft-blocked is en zo ja, door wie en wanneer?
     *
     * @throws Logic4ApiException
     */
    public function getIsPickbonSoftBlocked(
        int $value,
    ): PickbonSoftBlockedLogic4Response {
        return PickbonSoftBlockedLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Pickbons/GetIsPickbonSoftBlocked', ['json' => $value]),
            )
        );
    }

    /**
     * Verkrijg simpele pickbon rijen op basis van pickbon id.
     *
     * @throws Logic4ApiException
     */
    public function getOrderHeadPickbonRows(
        int $value,
    ): OrderHeadPickbonRowLogic4ResponseList {
        return OrderHeadPickbonRowLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Pickbons/GetOrderHeadPickbonRows', ['json' => $value]),
            )
        );
    }

    /**
     * Verkrijg simpele pickbon rijen op basis van pickbonnen.
     *
     * @param array<integer> $parameters
     *
     * @throws Logic4ApiException
     */
    public function getOrderHeadPickbonRowsForMultiplePickbons(
        array $parameters = [],
    ): OrderHeadPickbonRowLogic4ResponseList {
        return OrderHeadPickbonRowLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Pickbons/GetOrderHeadPickbonRowsForMultiplePickbons', ['json' => $parameters]),
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
     * Controleer of de pickbonnen soft-blocked zijn en zo ja, door wie en wanneer?
     *
     * @param array<integer> $parameters
     *
     * @throws Logic4ApiException
     */
    public function getPickbonsAreSoftBlocked(
        array $parameters = [],
    ): PickbonSoftBlockedLogic4ResponseList {
        return PickbonSoftBlockedLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Pickbons/GetPickbonsAreSoftBlocked', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg alle magazijnzones.
     *
     * @throws Logic4ApiException
     */
    public function getWarehouseZones(): WarehouseZoneLogic4ResponseList
    {
        return WarehouseZoneLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Pickbons/GetWarehouseZones'),
            )
        );
    }

    /**
     * Soft-blokkeer een pickbon.
     *
     * @throws Logic4ApiException
     */
    public function postSoftBlockPickbon(int $value): StringLogic4Response
    {
        return StringLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Pickbons/PostSoftBlockPickbon', ['json' => $value]),
            )
        );
    }

    /**
     * Soft-block meerdere pickbonnen.
     *
     * @param array<integer> $parameters
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
     * Verwerk een pickbon.
     *
     * @param array{
     *     AmountOfColli?: integer|null,
     *     Corrections?: array<mixed>|null,
     *     Mutations?: array<mixed>|null,
     *     OrderHeadPickbonId?: integer|null,
     *     Remarks?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function processPickbon(array $parameters = []): StringLogic4Response
    {
        return StringLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Pickbons/ProcessPickbon', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verwerk meerdere pickbonnen.
     *
     * @param array<array{
     *     AmountOfColli?: integer|null,
     *     Corrections?: array<mixed>|null,
     *     Mutations?: array<mixed>|null,
     *     OrderHeadPickbonId?: integer|null,
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
