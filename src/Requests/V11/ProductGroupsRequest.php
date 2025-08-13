<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V11;

use Webparking\Logic4Client\Data\V11\ProductGroup;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;

class ProductGroupsRequest extends Request
{
    /**
     * Verkrijg artikelgroepen o.b.v. het meegestuurde filter.
     *
     * @param array{
     *     SkipRecords?: int|null,
     *     TakeRecords?: int|null,
     *     IsTopLevelGroup?: bool|null,
     *     Name?: string|null,
     *     IsVisibleOnWebShop?: bool|null,
     *     ParentId?: int|null,
     *     HasProductsVisibleOnWebshop?: bool|null,
     *     ProductGroupTypeId?: int|null,
     *     WebsiteDomainId?: int|null,
     *     GlobalisationId?: int|null,
     * } $parameters
     *
     * @return \Generator<array-key, ProductGroup>
     *
     * @throws Logic4ApiException
     */
    public function getProductGroups(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1.1/ProductGroups/GetProductGroups', $parameters);

        foreach ($iterator as $record) {
            yield ProductGroup::make($record);
        }
    }
}
