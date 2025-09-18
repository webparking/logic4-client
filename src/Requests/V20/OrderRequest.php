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
     *     SkipRecords?: int|null,
     *     TakeRecords?: int|null,
     *     SolutionId?: int|null,
     *     ProblemId?: int|null,
     *     CategoryId?: int|null,
     *     BelongsToOrderId?: int|null,
     *     Id?: int|null,
     *     DebtorId?: int|null,
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
     *     LoadPayments?: bool|null,
     *     StatusId?: int|null,
     *     Type1Id?: int|null,
     *     Type2Id?: int|null,
     *     Type3Id?: int|null,
     *     WebsiteDomainIds?: array<int>|null,
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
