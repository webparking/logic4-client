<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\CountryLogic4ResponseList;
use Webparking\Logic4Client\Responses\GlobalizationTypeLogic4ResponseList;
use Webparking\Logic4Client\Responses\OperatingSystemTypeLogic4ResponseList;
use Webparking\Logic4Client\Responses\ProductRelationTypeLogic4ResponseList;
use Webparking\Logic4Client\Responses\ProvinceLogic4ResponseList;

class Type extends Request
{
    /**
     * Verkrijg alle landen o.b.v het opgestuurde filter.
     *
     * @param array{
     *     TypeZoneId?: integer,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getCountries(array $parameters = []): CountryLogic4ResponseList
    {
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
    public function getOperatingSystemTypes(): OperatingSystemTypeLogic4ResponseList
    {
        return OperatingSystemTypeLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Types/GetOperatingSystemTypes'),
            )
        );
    }

    /**
     * @throws Logic4ApiException
     */
    public function getProductRelationTypes(): ProductRelationTypeLogic4ResponseList
    {
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
     *     CountryId?: integer,
     *     ISOcode?: string,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getProvinces(array $parameters = []): ProvinceLogic4ResponseList
    {
        return ProvinceLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Types/GetProvinces', ['json' => $parameters]),
            )
        );
    }
}
