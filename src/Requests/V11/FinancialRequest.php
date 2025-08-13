<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V11;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V11\Int32Logic4Response;

class FinancialRequest extends Request
{
    /**
     * Maak een financiele inkoop dagboekboeking met mutaties aan.
     *
     * @param array{
     *     Description?: string|null,
     *     FinancialCostCenterId?: int|null,
     *     FreeValue1?: string|null,
     *     FreeValue2?: string|null,
     *     FreeValue3?: string|null,
     *     Reference?: string|null,
     *     BookingDateTime?: string|null,
     *     FinancialBookId?: int|null,
     *     JournalStatusId?: int|null,
     *     Mutations?: array<array{CreditorId?: int, BookingDateTime?: string, PaymentMethodId?: int|null, FinancialCostCenterId?: int|null, AmountIncl?: number}>|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addFinancialBuyBookingWithMutations(
        array $parameters = [],
    ): Int32Logic4Response {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.1/Financial/AddFinancialBuyBookingWithMutations', ['json' => $parameters]),
            )
        );
    }

    /**
     * Maak een financiele verkoop dagboekboeking met mutaties aan.
     *
     * @param array{
     *     Description?: string|null,
     *     FinancialCostCenterId?: int|null,
     *     FreeValue1?: string|null,
     *     FreeValue2?: string|null,
     *     FreeValue3?: string|null,
     *     Reference?: string|null,
     *     BookingDateTime?: string|null,
     *     FinancialBookId?: int|null,
     *     JournalStatusId?: int|null,
     *     Mutations?: array<array{DebtorId?: int, BookingDateTime?: string, PaymentMethodId?: int|null, FinancialCostCenterId?: int|null, AmountIncl?: number}>|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addFinancialSaleBookingWithMutations(
        array $parameters = [],
    ): Int32Logic4Response {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.1/Financial/AddFinancialSaleBookingWithMutations', ['json' => $parameters]),
            )
        );
    }
}
