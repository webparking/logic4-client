<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V30;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V30\Country;
use Webparking\Logic4Client\Responses\V30\GlobalizationType;
use Webparking\Logic4Client\Responses\V30\OperatingSystemType;
use Webparking\Logic4Client\Responses\V30\ProductRelationType;
use Webparking\Logic4Client\Responses\V30\Province;

class TypeRequest extends Request
{
    /**
     * Verkrijg alle landen o.b.v het opgestuurde filter.
     *
     * @param array{
     *     TypeZoneId?: int|null,
     * } $parameters
     *
     * @return array<array-key, Country>
     *
     * @throws Logic4ApiException
     */
    public function getCountries(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => Country::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Types/GetCountries', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Verkrijg alle globalisaties (talen).
     *
     * @return array<array-key, GlobalizationType>
     *
     * @throws Logic4ApiException
     */
    public function getGlobalizationTypes(): array
    {
        return array_map(
            static fn (array $data) => GlobalizationType::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/Types/GetGlobalizationTypes'),
            ),
        );
    }

    /**
     * Verkrijg alle operating system types.
     *
     * @return array<array-key, OperatingSystemType>
     *
     * @throws Logic4ApiException
     */
    public function getOperatingSystemTypes(): array
    {
        return array_map(
            static fn (array $data) => OperatingSystemType::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/Types/GetOperatingSystemTypes'),
            ),
        );
    }

    /**
     * Verkrijg alle product-relatietypes.
     *
     * @return array<array-key, ProductRelationType>
     *
     * @throws Logic4ApiException
     */
    public function getProductRelationTypes(): array
    {
        return array_map(
            static fn (array $data) => ProductRelationType::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/Types/GetProductRelationTypes'),
            ),
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
     * @return array<array-key, Province>
     *
     * @throws Logic4ApiException
     */
    public function getProvinces(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => Province::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Types/GetProvinces', ['json' => $parameters]),
            ),
        );
    }
}
