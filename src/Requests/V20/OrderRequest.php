<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V20;

use Webparking\Logic4Client\Data\V20\ReturnOrderV2;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;

class OrderRequest extends Request
{
    /**
     * Verkrijg retourorders o.b.v. het meegestuurde filter.
     *
     * @param array{
     *     ReceivedReturnOrderDateFrom?: string|null,
     *     ReceivedReturnOrderDateTo?: string|null,
     *     SkipRecords?: integer|null,
     *     TakeRecords?: integer|null,
     *     SolutionId?: integer|null,
     *     ProblemId?: integer|null,
     *     CategoryId?: integer|null,
     *     BelongsToOrderId?: integer|null,
     *     Id?: integer|null,
     *     DebtorId?: integer|null,
     *     CreationDateFrom?: string|null,
     *     CreationDateTo?: string|null,
     *     Barcode1?: string|null,
     *     ProductCode?: string|null,
     *     Delivery_Address?: string|null,
     *     Delivery_PostalCode?: string|null,
     *     Delivery_City?: string|null,
     *     Delivery_ContactName?: string|null,
     *     Delivery_CompanyName?: string|null,
     *     Delivery_Email?: string|null,
     *     Invoice_Address?: string|null,
     *     Invoice_PostalCode?: string|null,
     *     Invoice_City?: string|null,
     *     Invoice_ContactName?: string|null,
     *     Invoice_CompanyName?: string|null,
     *     Invoice_Email?: string|null,
     *     LastActionFrom?: string|null,
     *     LastActionTo?: string|null,
     *     Reference?: string|null,
     *     LoadPayments?: boolean|null,
     *     StatusId?: integer|null,
     *     Type1Id?: integer|null,
     *     Type2Id?: integer|null,
     *     Type3Id?: integer|null,
     * } $parameters
     *
     * @return \Generator<array-key, ReturnOrderV2>
     *
     * @throws Logic4ApiException
     */
    public function getReturnOrders(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v2/Orders/GetReturnOrders', $parameters);

        foreach ($iterator as $record) {
            yield ReturnOrderV2::make($record);
        }
    }
}
