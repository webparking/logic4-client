<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V10;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfCountry;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfGlobalizationType;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfOperatingSystemType;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfProductRelationType;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfProvince;

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
    ): Logic4ResponseListOfCountry {
        return Logic4ResponseListOfCountry::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Types/GetCountries', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg alle globalisaties (talen).
     *
     * @throws Logic4ApiException
     */
    public function getGlobalizationTypes(): Logic4ResponseListOfGlobalizationType
    {
        return Logic4ResponseListOfGlobalizationType::make(
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
    ): Logic4ResponseListOfOperatingSystemType {
        return Logic4ResponseListOfOperatingSystemType::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Types/GetOperatingSystemTypes'),
            )
        );
    }

    /**
     * Verkrijg alle product-relatietypes.
     *
     * @throws Logic4ApiException
     */
    public function getProductRelationTypes(
    ): Logic4ResponseListOfProductRelationType {
        return Logic4ResponseListOfProductRelationType::make(
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
    ): Logic4ResponseListOfProvince {
        return Logic4ResponseListOfProvince::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Types/GetProvinces', ['json' => $parameters]),
            )
        );
    }
}
