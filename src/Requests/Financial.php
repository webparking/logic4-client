<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests;

use Webparking\Logic4Client\Data\FinancialJournal;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\PaginatedResponse;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\BooleanLogic4Response;
use Webparking\Logic4Client\Responses\FinancialBookLogic4ResponseList;
use Webparking\Logic4Client\Responses\LedgerLogic4ResponseList;
use Webparking\Logic4Client\Responses\PaymentMethodLogic4ResponseList;
use Webparking\Logic4Client\Responses\StringLogic4Response;
use Webparking\Logic4Client\Responses\TypeCostCenterLogic4ResponseList;
use Webparking\Logic4Client\Responses\TypeEntityCodeLogic4ResponseList;
use Webparking\Logic4Client\Responses\TypeLedgerColumnLogic4ResponseList;
use Webparking\Logic4Client\Responses\TypeTransactionCodeLogic4ResponseList;
use Webparking\Logic4Client\Responses\VatCodeLogic4ResponseList;

class Financial extends Request
{
    /**
     * Maak een financiele dagboekboeking met mutaties aan.
     *
     * @param array{
     *     FreeValue1?: string,
     *     FreeValue2?: string,
     *     FreeValue3?: string,
     *     Description?: string,
     *     Reference?: string,
     *     BookingDateTime?: string,
     *     FinancialBookId?: integer,
     *     Mutations?: array<mixed>,
     * } $parameters
     *
     * @throws Logic4ApiException
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
     * Verkrijg de beschikbare financiële dagboeken o.b.v. het aangeleverde filter.
     *
     * @param array{
     *     LedgerId?: integer,
     *     FinancialBookType?: integer,
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
     *     LedgerCode?: integer,
     *     DateTimeFrom?: string,
     *     DateTimeTo?: string,
     *     SkipRecords?: integer,
     *     TakeRecords?: integer,
     * } $parameters
     *
     * @return PaginatedResponse<FinancialJournal>
     *
     * @throws Logic4ApiException
     */
    public function getFinancialJournals(array $parameters = []): PaginatedResponse
    {
        return new PaginatedResponse(
            $this->paginateRecords('/v1/Financial/GetFinancialJournals', $parameters),
            FinancialJournal::class,
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
    public function getTypeTransactionCodes(): TypeTransactionCodeLogic4ResponseList
    {
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
     *     Xml?: string,
     *     BookId?: integer,
     *     StatusId?: integer,
     *     UserId?: integer,
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
