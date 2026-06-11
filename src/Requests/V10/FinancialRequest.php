<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V10;

use Webparking\Logic4Client\Data\V10\FinancialBookBooking;
use Webparking\Logic4Client\Data\V10\FinancialJournal;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfFinancialBook;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfFinancialJournalStatus;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfLedger;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfPaymentMethod;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfTypeCostCenter;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfTypeEntityCode;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfTypeFinancialBookingStatus;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfTypeLedgerColumn;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfTypeTransactionCode;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfVatCode;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseOfboolean;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseOfint;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseOfstring;

class FinancialRequest extends Request
{
    /**
     * Maak een financiële dagboekboeking met mutaties aan.
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
     *     Mutations?: array<array{CreditorId?: int|null, DebtorId?: int|null, BookingDateTime?: string, PaymentMethodId?: int|null, FinancialCostCenterId?: int|null, AmountIncl?: number}>,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addFinancialBookingWithMutations(
        array $parameters = [],
    ): Logic4ResponseOfboolean {
        return Logic4ResponseOfboolean::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Financial/AddFinancialBookingWithMutations', ['json' => $parameters]),
            )
        );
    }

    /**
     * Maak een financiële memoriaal dagboekboeking met mutaties aan.
     * Geeft terug het id van de aangemaakte boeking.
     * Voor deze aanroep zijn extra rechten vereist.
     *
     * @param array{
     *     FreeValue1?: string|null,
     *     FreeValue2?: string|null,
     *     FreeValue3?: string|null,
     *     Reference?: string|null,
     *     BookingDateTime?: string,
     *     FinancialBookId?: int,
     *     JournalStatusId?: int|null,
     *     Mutations?: array<array{VatCode?: int, LedgerId?: int, Description?: string|null, AmountIncl?: number}>,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addFinancialGeneralBookingWithMutations(
        array $parameters = [],
    ): Logic4ResponseOfint {
        return Logic4ResponseOfint::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Financial/AddFinancialGeneralBookingWithMutations', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg boeking status types.
     * Voor deze aanroep zijn extra rechten vereist.
     *
     * @throws Logic4ApiException
     */
    public function getBookingStatusTypes(
    ): Logic4ResponseListOfTypeFinancialBookingStatus {
        return Logic4ResponseListOfTypeFinancialBookingStatus::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Financial/GetBookingStatusTypes'),
            )
        );
    }

    /**
     * Financieel dagboekboeking met mutaties verkrijgen o.b.v. het aangeleverde filter.
     * Levert alleen boekingen uit verkoop, inkoop of memoriale dagboeken.
     * Voor deze aanroep zijn extra rechten vereist.
     *
     * @param array{
     *     BookingId?: int|null,
     *     FinancialBookId?: int|null,
     *     BookingDateTimeFrom?: string|null,
     *     BookingDateTimeTo?: string|null,
     *     SkipRecords?: int,
     *     TakeRecords?: int,
     *     Reference?: string|null,
     *     UserId?: int|null,
     *     BookingNumberByUser?: int|null,
     *     Description?: string|null,
     *     DebtorId?: int|null,
     *     CreditorId?: int|null,
     *     StatusId?: int|null,
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
     *     LedgerId?: int|null,
     *     FinancialBookType?: int|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getFinancialBooks(
        array $parameters = [],
    ): Logic4ResponseListOfFinancialBook {
        return Logic4ResponseListOfFinancialBook::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Financial/GetFinancialBooks', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg de financiële journalen o.b.v. het aangeleverde filter.
     * Voor deze aanroep zijn extra rechten vereist.
     *
     * @param array{
     *     LedgerCode?: int|null,
     *     DateTimeFrom?: string|null,
     *     DateTimeTo?: string|null,
     *     SkipRecords?: int,
     *     TakeRecords?: int,
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
    ): Logic4ResponseListOfFinancialJournalStatus {
        return Logic4ResponseListOfFinancialJournalStatus::make(
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
    public function getLedgerColumnTypes(): Logic4ResponseListOfTypeLedgerColumn
    {
        return Logic4ResponseListOfTypeLedgerColumn::make(
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
    public function getLedgers(): Logic4ResponseListOfLedger
    {
        return Logic4ResponseListOfLedger::make(
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
    public function getPaymentMethods(): Logic4ResponseListOfPaymentMethod
    {
        return Logic4ResponseListOfPaymentMethod::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Financial/GetPaymentMethods'),
            )
        );
    }

    /**
     * Verkrijg type Kosten Centra.
     * Voor deze aanroep zijn extra rechten vereist.
     *
     * @throws Logic4ApiException
     */
    public function getTypeCostCenters(): Logic4ResponseListOfTypeCostCenter
    {
        return Logic4ResponseListOfTypeCostCenter::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Financial/GetTypeCostCenters'),
            )
        );
    }

    /**
     * Verkrijg type Entiteit Codes.
     * Voor deze aanroep zijn extra rechten vereist.
     *
     * @throws Logic4ApiException
     */
    public function getTypeEntityCodes(): Logic4ResponseListOfTypeEntityCode
    {
        return Logic4ResponseListOfTypeEntityCode::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Financial/GetTypeEntityCodes'),
            )
        );
    }

    /**
     * Verkrijg type Transactie Codes.
     * Voor deze aanroep zijn extra rechten vereist.
     *
     * @throws Logic4ApiException
     */
    public function getTypeTransactionCodes(
    ): Logic4ResponseListOfTypeTransactionCode {
        return Logic4ResponseListOfTypeTransactionCode::make(
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
    public function getVatCodes(): Logic4ResponseListOfVatCode
    {
        return Logic4ResponseListOfVatCode::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Financial/GetVatCodes'),
            )
        );
    }

    /**
     * Importeer UBL factuur naar het inkoopboek.
     * <br />
     * Indien het veld CreditorID wordt meegegeven in de request, wordt de betreffende crediteur direct gekoppeld aan de nieuwe inkoopboeking.
     * Wanneer het veld CreditorID leeg wordt gelaten, probeert het systeem automatisch een crediteur te matchen. Dit gebeurt op basis van een aantal regels.
     * <br />
     * Eerst worden er crediteuren gematched op basis van het KvK-nummer en het btw-nummer.
     * Alléén als dit geen resultaat levert, probeert het systeem te matchen op bedrijfsnaam, postcode en stadsnaam (alleen velden die in de UBL gevuld zijn worden gebruikt.)
     * Nadat er gematched is wordt er een crediteur gekozen of gecreëerd afhankelijk van het volgende:
     * <br />
     * <ul></ul>.
     *
     * @param array{
     *     Xml?: string|null,
     *     BookId?: int,
     *     StatusId?: int,
     *     UserId?: int|null,
     *     CreditorId?: int|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function postUblInvoiceToBuyBooking(
        array $parameters = [],
    ): Logic4ResponseOfstring {
        return Logic4ResponseOfstring::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Financial/PostUblInvoiceToBuyBooking', ['json' => $parameters]),
            )
        );
    }

    /**
     * Wijzig de status van een financiële boeking.
     * Geeft terug het id van de gewijzigde boeking.
     * Voor deze aanroep zijn extra rechten vereist.
     *
     * @param array{
     *     BookingId?: int,
     *     StatusId?: int,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function updateFinancialBookingStatus(
        array $parameters = [],
    ): Logic4ResponseOfint {
        return Logic4ResponseOfint::make(
            $this->buildResponse(
                $this->getClient()->patch('/v1/Financial/UpdateFinancialBookingStatus', ['json' => $parameters]),
            )
        );
    }
}
