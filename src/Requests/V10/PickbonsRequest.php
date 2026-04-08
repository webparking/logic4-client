<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V10;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V10\Int32Logic4ResponseList;
use Webparking\Logic4Client\Responses\V10\OrderHeadPickbonLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\OrderHeadPickbonRowLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\PickbonSoftBlockedLogic4Response;
use Webparking\Logic4Client\Responses\V10\PickbonSoftBlockedLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\StringLogic4Response;
use Webparking\Logic4Client\Responses\V10\WarehouseZoneLogic4ResponseList;

class PickbonsRequest extends Request
{
    /**
     * Maak nieuwe pickbon(nen) aan voor een gehele order op het moment dat de 'nog te leveren' regels volledig gepickt kunnen worden.
     *
     * @throws Logic4ApiException
     *
     * @deprecated Let op! Versie 1.0 is verouderd. Gebruik versie v3.0. - Maak nieuwe pickbon(nen) aan wanneer de 'nog te leveren' regels volledig gepickt kunnen worden
     */
    public function createCompletePickbonForOrder(
        int $value,
    ): Int32Logic4ResponseList {
        return Int32Logic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Pickbons/CreateCompletePickbonForOrder', ['json' => $value]),
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
     * @param array<int> $parameters
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
     *     OnlyUnprocessedItems?: bool|null,
     *     OrderCreatedFrom?: string|null,
     *     WarehouseZoneId?: int|null,
     *     WarehouseId?: int|null,
     *     PickBonId?: int|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     *
     * @deprecated Let op! Versie 1.0 is verouderd. Gebruik versie v3.0. - Verkrijg pickbonnen op basis van het meegegeven filter
     */
    public function getOrderHeadPickbons(
        array $parameters = [],
    ): OrderHeadPickbonLogic4ResponseList {
        return OrderHeadPickbonLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Pickbons/GetOrderHeadPickbons', ['json' => $parameters]),
            )
        );
    }

    /**
     * Controleer of de pickbonnen soft-blocked zijn en zo ja, door wie en wanneer?
     *
     * @param array<int> $parameters
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
     * @param array<int> $parameters
     *
     * @throws Logic4ApiException
     *
     * @deprecated Let op! Versie 1.0 is verouderd. Gebruik versie v3.0. - Soft-block meerdere pickbonnen
     */
    public function postSoftBlockPickbons(
        array $parameters = [],
    ): StringLogic4Response {
        return StringLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Pickbons/PostSoftBlockPickbons', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verwerk een pickbon.
     *
     * @param array{
     *     AmountOfColli?: int|null,
     *     Corrections?: array<array{OrderRowId?: int, OrderHeadPickbonId?: int, Qty?: number}>|null,
     *     Mutations?: array<array{OrderHeadPickbonRowId?: int, WarehouseStockLocationId?: int, MutationAmount?: number}>|null,
     *     OrderHeadPickbonId?: int|null,
     *     InterimLocationId?: int|null,
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
     *     AmountOfColli?: int|null,
     *     Corrections?: array<array{OrderRowId?: int, OrderHeadPickbonId?: int, Qty?: number}>|null,
     *     Mutations?: array<array{OrderHeadPickbonRowId?: int, WarehouseStockLocationId?: int, MutationAmount?: number}>|null,
     *     OrderHeadPickbonId?: int|null,
     *     InterimLocationId?: int|null,
     *     Remarks?: string|null,
     * }> $parameters
     *
     * @throws Logic4ApiException
     *
     * @deprecated Let op! Versie 1.0 is verouderd. Gebruik versie v3.0. - Verwerk meerdere pickbonnen
     */
    public function processPickbons(array $parameters = []): StringLogic4Response
    {
        return StringLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Pickbons/ProcessPickbons', ['json' => $parameters]),
            )
        );
    }
}
