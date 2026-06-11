<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V20;

use Webparking\Logic4Client\Data\V20\ProductSEOInformation;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V20\Logic4ResponseListOfProductDimensions;
use Webparking\Logic4Client\Responses\V20\Logic4ResponseListOfProductImageV2;

class ProductRequest extends Request
{
    /**
     * Verkrijg de afmetingen van meerdere artikelen.
     *
     * @param array{
     *     ProductIds?: array<int>,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getProductDimensions(
        array $parameters = [],
    ): Logic4ResponseListOfProductDimensions {
        return Logic4ResponseListOfProductDimensions::make(
            $this->buildResponse(
                $this->getClient()->post('/v2/Products/GetProductDimensions', ['json' => $parameters]),
            )
        );
    }

    /**
     * Ontvang de afbeeldingsinformatie van maximaal 1000 artikelen.
     *
     * @param array{
     *     ProductIds?: array<int>,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getProductImages(
        array $parameters = [],
    ): Logic4ResponseListOfProductImageV2 {
        return Logic4ResponseListOfProductImageV2::make(
            $this->buildResponse(
                $this->getClient()->post('/v2/Products/GetProductImages', ['json' => $parameters]),
            )
        );
    }

    /**
     * Het verkrijgen van informatie is maximaal 1.000 producten.
     *
     * @param array{
     *     SkipRecords?: int,
     *     TakeRecords?: int,
     *     ProductIds?: array<int>,
     *     WebsiteDomainId?: int|null,
     *     GlobalizationId?: int|null,
     *     ProductId?: int|null,
     * } $parameters
     *
     * @return \Generator<array-key, ProductSEOInformation>
     *
     * @throws Logic4ApiException
     */
    public function getProductsSEOInformation(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v2/Products/GetProductsSEOInformation', $parameters);

        foreach ($iterator as $record) {
            yield ProductSEOInformation::make($record);
        }
    }
}
