<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V30;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V30\FinancialBook;
use Webparking\Logic4Client\Responses\V30\FinancialBookBooking;
use Webparking\Logic4Client\Responses\V30\FinancialJournal;
use Webparking\Logic4Client\Responses\V30\FinancialJournalStatus;
use Webparking\Logic4Client\Responses\V30\Ledger;
use Webparking\Logic4Client\Responses\V30\PaymentMethodV3;
use Webparking\Logic4Client\Responses\V30\TypeCostCenter;
use Webparking\Logic4Client\Responses\V30\TypeEntityCode;
use Webparking\Logic4Client\Responses\V30\TypeFinancialBookingStatus;
use Webparking\Logic4Client\Responses\V30\TypeLedgerColumn;
use Webparking\Logic4Client\Responses\V30\TypeTransactionCode;
use Webparking\Logic4Client\Responses\V30\VatCode;

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
    public function addFinancialBuyBookingWithMutations(array $parameters = []): int
    {
        return $this->buildResponse(
            $this->getClient()->post('/v3/Financial/AddFinancialBuyBookingWithMutations', ['json' => $parameters]),
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
    public function addFinancialGeneralBookingWithMutations(array $parameters = []): int
    {
        return $this->buildResponse(
            $this->getClient()->post('/v3/Financial/AddFinancialGeneralBookingWithMutations', ['json' => $parameters]),
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
    public function addFinancialSaleBookingWithMutations(array $parameters = []): int
    {
        return $this->buildResponse(
            $this->getClient()->post('/v3/Financial/AddFinancialSaleBookingWithMutations', ['json' => $parameters]),
        );
    }

    /**
     * Verkrijg boeking status types.
     * Voor deze aanroep zijn extra rechten vereist.
     *
     * @return array<array-key, TypeFinancialBookingStatus>
     *
     * @throws Logic4ApiException
     */
    public function getBookingStatusTypes(): array
    {
        return array_map(
            static fn (array $data) => TypeFinancialBookingStatus::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/Financial/GetBookingStatusTypes'),
            ),
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
     * @return array<array-key, FinancialBookBooking>
     *
     * @throws Logic4ApiException
     */
    public function getFinancialBookingsWithMutations(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => FinancialBookBooking::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Financial/GetFinancialBookingsWithMutations', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Verkrijg de beschikbare financiële dagboeken o.b.v. het aangeleverde filter.
     *
     * @param array{
     *     LedgerId?: int|null,
     *     FinancialBookType?: int|null,
     * } $parameters
     *
     * @return array<array-key, FinancialBook>
     *
     * @throws Logic4ApiException
     */
    public function getFinancialBooks(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => FinancialBook::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Financial/GetFinancialBooks', ['json' => $parameters]),
            ),
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
     * @return array<array-key, FinancialJournal>
     *
     * @throws Logic4ApiException
     */
    public function getFinancialJournals(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => FinancialJournal::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Financial/GetFinancialJournals', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Verkrijg alle mogelijke statussen van financiële journalen.
     *
     * @return array<array-key, FinancialJournalStatus>
     *
     * @throws Logic4ApiException
     */
    public function getFinancialJournalStatuses(): array
    {
        return array_map(
            static fn (array $data) => FinancialJournalStatus::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/Financial/GetFinancialJournalStatuses'),
            ),
        );
    }

    /**
     * Verkrijg de beschikbare grootboek categorieën.
     *
     * @return array<array-key, TypeLedgerColumn>
     *
     * @throws Logic4ApiException
     */
    public function getLedgerColumnTypes(): array
    {
        return array_map(
            static fn (array $data) => TypeLedgerColumn::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/Financial/GetLedgerColumnTypes'),
            ),
        );
    }

    /**
     * Verkrijg alle grootboeken.
     *
     * @return array<array-key, Ledger>
     *
     * @throws Logic4ApiException
     */
    public function getLedgers(): array
    {
        return array_map(
            static fn (array $data) => Ledger::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/Financial/GetLedgers'),
            ),
        );
    }

    /**
     * Verkrijg alle betaalmethodes.
     *
     * @return array<array-key, PaymentMethodV3>
     *
     * @throws Logic4ApiException
     */
    public function getPaymentMethods(): array
    {
        return array_map(
            static fn (array $data) => PaymentMethodV3::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/Financial/GetPaymentMethods'),
            ),
        );
    }

    /**
     * Verkrijg type Kosten Centra.
     * Voor deze aanroep zijn extra rechten vereist.
     *
     * @return array<array-key, TypeCostCenter>
     *
     * @throws Logic4ApiException
     */
    public function getTypeCostCenters(): array
    {
        return array_map(
            static fn (array $data) => TypeCostCenter::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/Financial/GetTypeCostCenters'),
            ),
        );
    }

    /**
     * Verkrijg type Entiteit Codes.
     * Voor deze aanroep zijn extra rechten vereist.
     *
     * @return array<array-key, TypeEntityCode>
     *
     * @throws Logic4ApiException
     */
    public function getTypeEntityCodes(): array
    {
        return array_map(
            static fn (array $data) => TypeEntityCode::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/Financial/GetTypeEntityCodes'),
            ),
        );
    }

    /**
     * Verkrijg type Transactie Codes.
     * Voor deze aanroep zijn extra rechten vereist.
     *
     * @return array<array-key, TypeTransactionCode>
     *
     * @throws Logic4ApiException
     */
    public function getTypeTransactionCodes(): array
    {
        return array_map(
            static fn (array $data) => TypeTransactionCode::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/Financial/GetTypeTransactionCodes'),
            ),
        );
    }

    /**
     * Verkrijg alle BTW codes.
     *
     * @return array<array-key, VatCode>
     *
     * @throws Logic4ApiException
     */
    public function getVatCodes(): array
    {
        return array_map(
            static fn (array $data) => VatCode::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/Financial/GetVatCodes'),
            ),
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
     * - Als er één unieke match wordt gevonden, wordt deze crediteur gekoppeld aan de inkoopboeking.
     * - Als er geen match wordt gevonden, wordt automatisch een nieuwe crediteur aangemaakt.
     * - Als er meerdere crediteuren zijn gematched, wordt er ook een nieuwe crediteur aangemaakt in plaats van dat er een bestaande gebruikt wordt.
     * <br />
     * <b>Grootboek per regel:</b> Het systeem leest het grootboeknummer uit de UBL per InvoiceLine via het element
     * cac:AdditionalItemProperty met naam "Ledger". De waarde is het grootboeknummer (niet het ledger ID).
     * Deze zijn via het eindpunt /Financial/GetLedgers op te vragen.
     * Indien het grootboek niet wordt gevonden of geblokkeerd is, wordt het default grootboek van de crediteur gebruikt.
     * <br />
     * <b>BTW code overrule:</b> Per InvoiceLine kan de BTW code worden overruled via cac:AdditionalItemProperty met
     * naam "L4VatCodeIdOverrule" en als waarde het VatCodeId. Het BTW percentage in de UBL moet overeenkomen met het
     * percentage van de gekozen BTW code, anders wordt de boeking afgewezen.
     * <br />
     * <b>Gesloten periode:</b> Indien de boekingsdatum in een gesloten periode valt, wordt de boeking niet aangemaakt
     * en retourneert het endpoint een foutmelding.
     *
     * @param array{
     *     Xml?: string|null,
     *     BookId?: int,
     *     StatusId?: int,
     *     UserId?: int|null,
     *     CreditorId?: int|null,
     *     Description?: string|null,
     *     FreeValue1?: string|null,
     *     FreeValue2?: string|null,
     *     FreeValue3?: string|null,
     *     BookingDateTime?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function postUblInvoiceToBuyBooking(array $parameters = []): int
    {
        return $this->buildResponse(
            $this->getClient()->post('/v3/Financial/PostUblInvoiceToBuyBooking', ['json' => $parameters]),
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
    public function updateFinancialBookingStatus(array $parameters = []): void
    {
        $this->getClient()->patch('/v3/Financial/UpdateFinancialBookingStatus', ['json' => $parameters]);
    }
}
