<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V20;

use Webparking\Logic4Client\Data\V20\ProductSEOInformation;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V20\ProductDimensionsLogic4ResponseList;
use Webparking\Logic4Client\Responses\V20\ProductImageV2Logic4ResponseList;

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
    ): ProductDimensionsLogic4ResponseList {
        return ProductDimensionsLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v2/Products/GetProductDimensions', ['json' => $parameters]),
            )
        );
    }

    /**
     * @param array{
     *     ProductIds?: array<int>,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getProductImages(
        array $parameters = [],
    ): ProductImageV2Logic4ResponseList {
        return ProductImageV2Logic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v2/Products/GetProductImages', ['json' => $parameters]),
            )
        );
    }

    /**
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
