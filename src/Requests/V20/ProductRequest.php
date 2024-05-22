<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V20;

use Webparking\Logic4Client\Data\ProductSEOInformation;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\ProductImageV2Logic4ResponseList;

class ProductRequest extends Request
{
    /**
     * @param array{
     *     ProductIds?: array<integer>|null,
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
     *     SkipRecords?: integer|null,
     *     TakeRecords?: integer|null,
     *     ProductIds?: array<integer>|null,
     *     WebsiteDomainId?: integer|null,
     *     GlobalizationId?: integer|null,
     *     ProductId?: integer|null,
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
