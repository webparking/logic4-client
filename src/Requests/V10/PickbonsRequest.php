<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V10;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfint;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfOrderHeadPickbon;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfOrderHeadPickbonRow;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfPickbonSoftBlocked;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfWarehouseZone;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseOfPickbonSoftBlocked;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseOfstring;

class PickbonsRequest extends Request
{
    /**
     * Maak nieuwe pickbon(nen) aan voor een gehele order op het moment dat de 'nog te leveren' regels volledig gepickt kunnen worden.
     *
     * @throws Logic4ApiException
     */
    public function createCompletePickbonForOrder(
        int $value,
    ): Logic4ResponseListOfint {
        return Logic4ResponseListOfint::make(
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
    public function createPickbonForOrder(int $value): Logic4ResponseListOfint
    {
        return Logic4ResponseListOfint::make(
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
    ): Logic4ResponseOfPickbonSoftBlocked {
        return Logic4ResponseOfPickbonSoftBlocked::make(
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
    ): Logic4ResponseListOfOrderHeadPickbonRow {
        return Logic4ResponseListOfOrderHeadPickbonRow::make(
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
    ): Logic4ResponseListOfOrderHeadPickbonRow {
        return Logic4ResponseListOfOrderHeadPickbonRow::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Pickbons/GetOrderHeadPickbonRowsForMultiplePickbons', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg pickbonnen op basis van het meegegeven filter.
     *
     * @param array{
     *     OnlyUnprocessedItems?: bool,
     *     OrderCreatedFrom?: string|null,
     *     WarehouseZoneId?: int|null,
     *     WarehouseId?: int|null,
     *     PickBonId?: int|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getOrderHeadPickbons(
        array $parameters = [],
    ): Logic4ResponseListOfOrderHeadPickbon {
        return Logic4ResponseListOfOrderHeadPickbon::make(
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
    ): Logic4ResponseListOfPickbonSoftBlocked {
        return Logic4ResponseListOfPickbonSoftBlocked::make(
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
    public function getWarehouseZones(): Logic4ResponseListOfWarehouseZone
    {
        return Logic4ResponseListOfWarehouseZone::make(
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
    public function postSoftBlockPickbon(int $value): Logic4ResponseOfstring
    {
        return Logic4ResponseOfstring::make(
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
     */
    public function postSoftBlockPickbons(
        array $parameters = [],
    ): Logic4ResponseOfstring {
        return Logic4ResponseOfstring::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Pickbons/PostSoftBlockPickbons', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verwerk een pickbon.
     *
     * @param array{
     *     AmountOfColli?: int,
     *     Corrections?: array<array{}>,
     *     Mutations?: array<array{OrderHeadPickbonRowId?: int, WarehouseStockLocationId?: int, MutationAmount?: number}>,
     *     OrderHeadPickbonId?: int,
     *     InterimLocationId?: int|null,
     *     Remarks?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function processPickbon(array $parameters = []): Logic4ResponseOfstring
    {
        return Logic4ResponseOfstring::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Pickbons/ProcessPickbon', ['json' => $parameters]),
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
                $this->getClient()->post('/v1/Pickbons/ProcessPickbons', ['json' => $parameters]),
            )
        );
    }
}
