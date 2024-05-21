<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V12;

use Webparking\Logic4Client\Data\Brand;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;

class ProductRequest extends Request
{
    /**
     * Haal merken op o.b.v. het filter.
     *
     * @param array{
     *     SkipRecords?: integer|null,
     *     TakeRecords?: integer|null,
     * } $parameters
     *
     * @return \Generator<array-key, Brand>
     *
     * @throws Logic4ApiException
     */
    public function getBrands(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1.2/Products/GetBrands', $parameters);

        foreach ($iterator as $record) {
            yield Brand::make($record);
        }
    }
}
