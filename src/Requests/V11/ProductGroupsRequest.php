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
     *     SkipRecords?: integer|null,
     *     TakeRecords?: integer|null,
     *     IsTopLevelGroup?: boolean|null,
     *     Name?: string|null,
     *     IsVisibleOnWebShop?: boolean|null,
     *     ParentId?: integer|null,
     *     HasProductsVisibleOnWebshop?: boolean|null,
     *     ProductGroupTypeId?: integer|null,
     *     WebsiteDomainId?: integer|null,
     *     GlobalisationId?: integer|null,
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
