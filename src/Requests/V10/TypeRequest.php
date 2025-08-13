<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V10;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V10\CountryLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\GlobalizationTypeLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\OperatingSystemTypeLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\ProductRelationTypeLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\ProvinceLogic4ResponseList;

class TypeRequest extends Request
{
    /**
     * Verkrijg alle landen o.b.v het opgestuurde filter.
     *
     * @param array{
     *     TypeZoneId?: int|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getCountries(
        array $parameters = [],
    ): CountryLogic4ResponseList {
        return CountryLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Types/GetCountries', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg alle globalisaties.
     *
     * @throws Logic4ApiException
     */
    public function getGlobalizationTypes(): GlobalizationTypeLogic4ResponseList
    {
        return GlobalizationTypeLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Types/GetGlobalizationTypes'),
            )
        );
    }

    /**
     * Verkrijg alle operating system types.
     *
     * @throws Logic4ApiException
     */
    public function getOperatingSystemTypes(
    ): OperatingSystemTypeLogic4ResponseList {
        return OperatingSystemTypeLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Types/GetOperatingSystemTypes'),
            )
        );
    }

    /**
     * @throws Logic4ApiException
     */
    public function getProductRelationTypes(
    ): ProductRelationTypeLogic4ResponseList {
        return ProductRelationTypeLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Types/GetProductRelationTypes'),
            )
        );
    }

    /**
     * Verkrijg alle provincies o.b.v. het opgestuurde filter.
     *
     * @param array{
     *     CountryId?: int|null,
     *     ISOcode?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getProvinces(
        array $parameters = [],
    ): ProvinceLogic4ResponseList {
        return ProvinceLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Types/GetProvinces', ['json' => $parameters]),
            )
        );
    }
}
