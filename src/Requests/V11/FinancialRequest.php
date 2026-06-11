<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V11;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V11\Logic4ResponseOfint;

class FinancialRequest extends Request
{
    /**
     * Maak een financiële inkoop dagboekboeking met mutaties aan.
     * Geeft terug het id van de aangemaakte boeking.
     * Voor deze aanroep zijn extra rechten vereist.
     *
     * @param array{
     *     Description?: string|null,
     *     FinancialCostCenterId?: int|null,
     *     FreeValue1?: string|null,
     *     FreeValue2?: string|null,
     *     FreeValue3?: string|null,
     *     Reference?: string|null,
     *     BookingDateTime?: string,
     *     FinancialBookId?: int,
     *     JournalStatusId?: int|null,
     *     Mutations?: array<array{CreditorId?: int|null, BookingDateTime?: string, PaymentMethodId?: int|null, FinancialCostCenterId?: int|null, AmountIncl?: number}>,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addFinancialBuyBookingWithMutations(
        array $parameters = [],
    ): Logic4ResponseOfint {
        return Logic4ResponseOfint::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.1/Financial/AddFinancialBuyBookingWithMutations', ['json' => $parameters]),
            )
        );
    }

    /**
     * Maak een financiële verkoop dagboekboeking met mutaties aan.
     * Geeft terug het id van de aangemaakte boeking.
     * Voor deze aanroep zijn extra rechten vereist.
     *
     * @param array{
     *     Description?: string|null,
     *     FinancialCostCenterId?: int|null,
     *     FreeValue1?: string|null,
     *     FreeValue2?: string|null,
     *     FreeValue3?: string|null,
     *     Reference?: string|null,
     *     BookingDateTime?: string,
     *     FinancialBookId?: int,
     *     JournalStatusId?: int|null,
     *     Mutations?: array<array{DebtorId?: int|null, BookingDateTime?: string, PaymentMethodId?: int|null, FinancialCostCenterId?: int|null, AmountIncl?: number}>,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addFinancialSaleBookingWithMutations(
        array $parameters = [],
    ): Logic4ResponseOfint {
        return Logic4ResponseOfint::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.1/Financial/AddFinancialSaleBookingWithMutations', ['json' => $parameters]),
            )
        );
    }
}
