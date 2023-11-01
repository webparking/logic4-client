<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests;

use Webparking\Logic4Client\Data\OrderHeadPickbon;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\PaginatedResponse;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\Int32Logic4ResponseList;
use Webparking\Logic4Client\Responses\OrderHeadPickbonRowLogic4ResponseList;
use Webparking\Logic4Client\Responses\PickbonSoftBlockedLogic4Response;
use Webparking\Logic4Client\Responses\PickbonSoftBlockedLogic4ResponseList;
use Webparking\Logic4Client\Responses\StringLogic4Response;
use Webparking\Logic4Client\Responses\WarehouseZoneLogic4ResponseList;

class Pickbons extends Request
{
    /**
     * @param array{
     *     OrderId?: integer,
     *     UseNewWorkflow?: boolean,
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
    public function createPickbonForOrder(): Int32Logic4ResponseList
    {
        return Int32Logic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Pickbons/CreatePickbonForOrder'),
            )
        );
    }

    /**
     * Controleer of de pickbon soft-blocked is en zo ja, door wie en wanneer?
     *
     * @throws Logic4ApiException
     */
    public function getIsPickbonSoftBlocked(): PickbonSoftBlockedLogic4Response
    {
        return PickbonSoftBlockedLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Pickbons/GetIsPickbonSoftBlocked'),
            )
        );
    }

    /**
     * Verkrijg simpele pickbon rijen op basis van pickbon id.
     *
     * @throws Logic4ApiException
     */
    public function getOrderHeadPickbonRows(): OrderHeadPickbonRowLogic4ResponseList
    {
        return OrderHeadPickbonRowLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Pickbons/GetOrderHeadPickbonRows'),
            )
        );
    }

    /**
     * Verkrijg simpele pickbon rijen op basis van pickbonnen.
     *
     * @throws Logic4ApiException
     */
    public function getOrderHeadPickbonRowsForMultiplePickbons(
    ): OrderHeadPickbonRowLogic4ResponseList {
        return OrderHeadPickbonRowLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Pickbons/GetOrderHeadPickbonRowsForMultiplePickbons'),
            )
        );
    }

    /**
     * Verkrijg pickbonnen op basis van het meegegeven filter.
     *
     * @param array{
     *     SkipRecords?: integer,
     *     TakeRecords?: integer,
     *     OnlyUnprocessedItems?: boolean,
     *     OrderCreatedFrom?: string,
     *     WarehouseZoneId?: integer,
     *     WarehouseId?: integer,
     *     PickBonId?: integer,
     * } $parameters
     *
     * @return PaginatedResponse<OrderHeadPickbon>
     *
     * @throws Logic4ApiException
     */
    public function getOrderHeadPickbons(array $parameters = []): PaginatedResponse
    {
        return new PaginatedResponse(
            $this->paginateRecords('/v1.1/Pickbons/GetOrderHeadPickbons', $parameters),
            OrderHeadPickbon::class,
        );
    }

    /**
     * Controleer of de pickbonnen soft-blocked zijn en zo ja, door wie en wanneer?
     *
     * @throws Logic4ApiException
     */
    public function getPickbonsAreSoftBlocked(): PickbonSoftBlockedLogic4ResponseList
    {
        return PickbonSoftBlockedLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Pickbons/GetPickbonsAreSoftBlocked'),
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
    public function postSoftBlockPickbon(): StringLogic4Response
    {
        return StringLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Pickbons/PostSoftBlockPickbon'),
            )
        );
    }

    /**
     * Soft-block meerdere pickbonnen.
     *
     * @throws Logic4ApiException
     */
    public function postSoftBlockPickbons(): StringLogic4Response
    {
        return StringLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.1/Pickbons/PostSoftBlockPickbons'),
            )
        );
    }

    /**
     * Verwerk een pickbon.
     *
     * @param array{
     *     AmountOfColli?: integer,
     *     Corrections?: array<mixed>,
     *     Mutations?: array<mixed>,
     *     OrderHeadPickbonId?: integer,
     *     Remarks?: string,
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
     * @throws Logic4ApiException
     */
    public function processPickbons(): StringLogic4Response
    {
        return StringLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.1/Pickbons/ProcessPickbons'),
            )
        );
    }
}
