<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V10;

use Webparking\Logic4Client\Data\V10\FinancialBookBooking;
use Webparking\Logic4Client\Data\V10\FinancialJournal;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V10\BooleanLogic4Response;
use Webparking\Logic4Client\Responses\V10\FinancialBookLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\FinancialJournalStatusLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\Int32Logic4Response;
use Webparking\Logic4Client\Responses\V10\LedgerLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\PaymentMethodLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\StringLogic4Response;
use Webparking\Logic4Client\Responses\V10\TypeCostCenterLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\TypeEntityCodeLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\TypeLedgerColumnLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\TypeTransactionCodeLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\VatCodeLogic4ResponseList;

class FinancialRequest extends Request
{
    /**
     * Maak een financiele dagboekboeking met mutaties aan.
     *
     * @param array{
     *     Description?: string|null,
     *     FinancialCostCenterId?: integer|null,
     *     FreeValue1?: string|null,
     *     FreeValue2?: string|null,
     *     FreeValue3?: string|null,
     *     Reference?: string|null,
     *     BookingDateTime?: string|null,
     *     FinancialBookId?: integer|null,
     *     JournalStatusId?: integer|null,
     *     Mutations?: array<array{CreditorId?: integer|null, DebtorId?: integer|null, BookingDateTime?: string, PaymentMethodId?: integer|null, FinancialCostCenterId?: integer|null, AmountIncl?: number}>|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     *
     * @deprecated Let op! Versie 1.0 is verouderd. Gebruik een nieuwere versie. - Financiële dagboekboeking met mutaties aanmaken
     */
    public function addFinancialBookingWithMutations(
        array $parameters = [],
    ): BooleanLogic4Response {
        return BooleanLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Financial/AddFinancialBookingWithMutations', ['json' => $parameters]),
            )
        );
    }

    /**
     * Maak een financiele memoriaal dagboekboeking met mutaties aan.
     *
     * @param array{
     *     FreeValue1?: string|null,
     *     FreeValue2?: string|null,
     *     FreeValue3?: string|null,
     *     Reference?: string|null,
     *     BookingDateTime?: string|null,
     *     FinancialBookId?: integer|null,
     *     JournalStatusId?: integer|null,
     *     Mutations?: array<array{VatCode?: integer, LedgerId?: integer, Description?: string|null, AmountIncl?: number}>|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addFinancialGeneralBookingWithMutations(
        array $parameters = [],
    ): Int32Logic4Response {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Financial/AddFinancialGeneralBookingWithMutations', ['json' => $parameters]),
            )
        );
    }

    /**
     * Financieel dagboekboeking met mutaties verkrijgen o.b.v. het aangeleverde filter.
     * Levert alleen boekingen uit verkoop, inkoop of memoriale dagboeken.
     *
     * @param array{
     *     BookingId?: integer|null,
     *     FinancialBookId?: integer|null,
     *     BookingDateTimeFrom?: string|null,
     *     BookingDateTimeTo?: string|null,
     *     SkipRecords?: integer|null,
     *     TakeRecords?: integer|null,
     *     Reference?: string|null,
     *     UserId?: integer|null,
     *     BookingNumberByUser?: integer|null,
     *     Description?: string|null,
     *     DebtorId?: integer|null,
     *     CreditorId?: integer|null,
     *     StatusId?: integer|null,
     *     FreeValue1?: string|null,
     *     FreeValue2?: string|null,
     *     FreeValue3?: string|null,
     * } $parameters
     *
     * @return \Generator<array-key, FinancialBookBooking>
     *
     * @throws Logic4ApiException
     */
    public function getFinancialBookingsWithMutations(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1/Financial/GetFinancialBookingsWithMutations', $parameters);

        foreach ($iterator as $record) {
            yield FinancialBookBooking::make($record);
        }
    }

    /**
     * Verkrijg de beschikbare financiële dagboeken o.b.v. het aangeleverde filter.
     *
     * @param array{
     *     LedgerId?: integer|null,
     *     FinancialBookType?: integer|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getFinancialBooks(
        array $parameters = [],
    ): FinancialBookLogic4ResponseList {
        return FinancialBookLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Financial/GetFinancialBooks', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg de financiële journalen o.b.v. het aangeleverde filter.
     *
     * Voor deze aanroep zijn extra rechten vereist.
     *
     * @param array{
     *     LedgerCode?: integer|null,
     *     DateTimeFrom?: string|null,
     *     DateTimeTo?: string|null,
     *     SkipRecords?: integer|null,
     *     TakeRecords?: integer|null,
     * } $parameters
     *
     * @return \Generator<array-key, FinancialJournal>
     *
     * @throws Logic4ApiException
     */
    public function getFinancialJournals(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1/Financial/GetFinancialJournals', $parameters);

        foreach ($iterator as $record) {
            yield FinancialJournal::make($record);
        }
    }

    /**
     * Verkrijg alle mogelijke statussen van financiële journalen.
     *
     * @throws Logic4ApiException
     */
    public function getFinancialJournalStatuses(
    ): FinancialJournalStatusLogic4ResponseList {
        return FinancialJournalStatusLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Financial/GetFinancialJournalStatuses'),
            )
        );
    }

    /**
     * Verkrijg de beschikbare grootboek categorieën.
     *
     * @throws Logic4ApiException
     */
    public function getLedgerColumnTypes(): TypeLedgerColumnLogic4ResponseList
    {
        return TypeLedgerColumnLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Financial/GetLedgerColumnTypes'),
            )
        );
    }

    /**
     * Verkrijg alle grootboeken.
     *
     * @throws Logic4ApiException
     */
    public function getLedgers(): LedgerLogic4ResponseList
    {
        return LedgerLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Financial/GetLedgers'),
            )
        );
    }

    /**
     * Verkrijg alle betaalmethodes.
     *
     * @throws Logic4ApiException
     */
    public function getPaymentMethods(): PaymentMethodLogic4ResponseList
    {
        return PaymentMethodLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Financial/GetPaymentMethods'),
            )
        );
    }

    /**
     * Voor deze aanroep zijn extra rechten vereist.
     *
     * @throws Logic4ApiException
     */
    public function getTypeCostCenters(): TypeCostCenterLogic4ResponseList
    {
        return TypeCostCenterLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Financial/GetTypeCostCenters'),
            )
        );
    }

    /**
     * Voor deze aanroep zijn extra rechten vereist.
     *
     * @throws Logic4ApiException
     */
    public function getTypeEntityCodes(): TypeEntityCodeLogic4ResponseList
    {
        return TypeEntityCodeLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Financial/GetTypeEntityCodes'),
            )
        );
    }

    /**
     * Voor deze aanroep zijn extra rechten vereist.
     *
     * @throws Logic4ApiException
     */
    public function getTypeTransactionCodes(
    ): TypeTransactionCodeLogic4ResponseList {
        return TypeTransactionCodeLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Financial/GetTypeTransactionCodes'),
            )
        );
    }

    /**
     * Verkrijg alle BTW codes.
     *
     * @throws Logic4ApiException
     */
    public function getVatCodes(): VatCodeLogic4ResponseList
    {
        return VatCodeLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Financial/GetVatCodes'),
            )
        );
    }

    /**
     * Plaats een UBL document in het inkoopboek. Deze worden opgeslagen als voorstellen, en moeten nog worden gecontroleerd voordat ze kunnen worden verwerkt.
     *
     * @param array{
     *     Xml?: string|null,
     *     BookId?: integer|null,
     *     StatusId?: integer|null,
     *     UserId?: integer|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function postUblInvoiceToBuyBooking(
        array $parameters = [],
    ): StringLogic4Response {
        return StringLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Financial/PostUblInvoiceToBuyBooking', ['json' => $parameters]),
            )
        );
    }
}
