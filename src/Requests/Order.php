<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests;

use Webparking\Logic4Client\Data\OrderOpenPayment;
use Webparking\Logic4Client\Data\ReturnProblem;
use Webparking\Logic4Client\Data\ReturnSolution;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\PaginatedResponse;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\BooleanLogic4Response;
use Webparking\Logic4Client\Responses\Int32Logic4Response;
use Webparking\Logic4Client\Responses\Int32Logic4ResponseList;
use Webparking\Logic4Client\Responses\InvoiceOpenPaymentLogic4ResponseList;
use Webparking\Logic4Client\Responses\OrderActionLogic4ResponseList;
use Webparking\Logic4Client\Responses\OrderActionTypeLogic4ResponseList;
use Webparking\Logic4Client\Responses\OrderLogic4ResponseList;
use Webparking\Logic4Client\Responses\OrderOpenPaymentLogic4Response;
use Webparking\Logic4Client\Responses\OrderRowLogic4ResponseList;
use Webparking\Logic4Client\Responses\OrderStatusLogic4ResponseList;
use Webparking\Logic4Client\Responses\ReturnCategoryLogic4ResponseList;

class Order extends Request
{
    /**
     * @param array{
     *     SerialNumberTypeId?: integer,
     *     OrderRowSerialNumbers?: array<mixed>,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addOrderRowSerialNumbers(
        array $parameters = [],
    ): Int32Logic4Response {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Orders/AddOrderRowSerialNumbers', ['json' => $parameters]),
            )
        );
    }

    /**
     * Voeg een betaling toe aan een order of factuur.
     *
     * @param array{
     *     OrderId?: integer,
     *     InvoiceId?: integer,
     *     AmountIncl?: number,
     *     Description?: string,
     *     BookingId?: integer,
     *     MatchingLedgerId?: integer,
     *     DateTime?: string,
     *     LedgerCode?: integer,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addPayment(array $parameters = []): BooleanLogic4Response
    {
        return BooleanLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Orders/AddPayment', ['json' => $parameters]),
            )
        );
    }

    /**
     * Wijzig of maak een nieuwe factuur aan, het is alleen mogelijk om stamgegevens van een factuur te updaten (status, NAW, betaal/verzendmethode).
     * Factuurregels kunnen slechts eenmalig bij het aanmaken van de factuur gevuld worden.
     * Bij het succesvol aanmaken/updaten wordt het (nieuwe) factuurnummer in de response gevuld.
     *
     * @param array{
     *     CheckForOrderCostAndPaymentRegulation?: boolean,
     *     DebtorId?: integer,
     *     Id?: integer,
     *     OrderRows?: array<mixed>,
     *     AcceptTermsAndConditions?: boolean,
     *     CreationDate?: string,
     *     Description?: string,
     *     Reference?: string,
     *     BranchId?: integer,
     *     UserId?: integer,
     *     WebsiteDomainId?: integer,
     *     DeliveryOptionId?: integer,
     *     DeliveryDate?: string,
     *     Notes?: string,
     *     FreeValue1?: string,
     *     FreeValue2?: string,
     *     FreeValue3?: string,
     *     FreeValue4?: string,
     *     FreeValue5?: string,
     *     FreeValue6?: string,
     *     FreeValue7?: string,
     *     FreeValue8?: string,
     *     OrderType1Id?: integer,
     *     OrderType2Id?: integer,
     *     OrderType3Id?: integer,
     *     OrderType4Id?: integer,
     *     OrderType5Id?: integer,
     *     OrderType6Id?: integer,
     *     OrderType7Id?: integer,
     *     OrderType8Id?: integer,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addUpdateInvoice(array $parameters = []): Int32Logic4Response
    {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.1/Orders/AddUpdateInvoice', ['json' => $parameters]),
            )
        );
    }

    /**
     * Wijzig of maak een nieuwe order aan, het is alleen mogelijk om stamgegevens van een order te updaten (status, NAW, betaal/verzendmethode).
     * Orderregels kunnen slechts eenmalig bij het aanmaken van de order gevuld worden.
     * Bij het succesvol aanmaken/updaten wordt het (nieuwe) ordernummer in de response gevuld.
     * Met v1.2 of hoger kan het Id van het afleveradres gebruikt worden om het afleveradres te bepalen.
     *
     * @param array{
     *     CheckForOrderCostAndPaymentRegulation?: boolean,
     *     DebtorId?: integer,
     *     Id?: integer,
     *     OrderRows?: array<mixed>,
     *     AcceptTermsAndConditions?: boolean,
     *     CreationDate?: string,
     *     Description?: string,
     *     Reference?: string,
     *     BranchId?: integer,
     *     UserId?: integer,
     *     WebsiteDomainId?: integer,
     *     DeliveryOptionId?: integer,
     *     DeliveryDate?: string,
     *     Notes?: string,
     *     FreeValue1?: string,
     *     FreeValue2?: string,
     *     FreeValue3?: string,
     *     FreeValue4?: string,
     *     FreeValue5?: string,
     *     FreeValue6?: string,
     *     FreeValue7?: string,
     *     FreeValue8?: string,
     *     OrderType1Id?: integer,
     *     OrderType2Id?: integer,
     *     OrderType3Id?: integer,
     *     OrderType4Id?: integer,
     *     OrderType5Id?: integer,
     *     OrderType6Id?: integer,
     *     OrderType7Id?: integer,
     *     OrderType8Id?: integer,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addUpdateOrder(array $parameters = []): Int32Logic4Response
    {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.2/Orders/AddUpdateOrder', ['json' => $parameters]),
            )
        );
    }

    /**
     * Voeg een nieuwe orderregel toe of update een bestaande. Om een bestaande te updaten dient het veld 'Id' gevuld te zijn met een bestaand orderregelnummer.
     * <br />
     * De optie "OrderRowWithProductComposition": {"AddProductCompositionByParentProductToOrder": true} heeft het volgende gedrag.
     * - Bij een nieuw product worden samenstellingen toegevoegd als het product een samengesteld product is.
     * - Bij een bestaand product worden samenstellingen toegevoegd mits er nog geen samenstellingen aanwezig zijn, anders komt er een foutmelding terug.
     *
     * De optie "ForceAddProductComposition" zorgt ervoor dat samenstellingen <strong>altijd</strong> worden toegevoegd, ongeacht of er reeds samenstellingen bestaan voor deze orderregel.
     *
     * @param array{
     *     InclPrice?: number,
     *     GrossInclPrice?: number,
     *     Id?: integer,
     *     Description?: string,
     *     Description2?: string,
     *     ProductId?: integer,
     *     Qty?: number,
     *     BuyPrice?: number,
     *     GrossPrice?: number,
     *     NettPrice?: number,
     *     QtyDeliverd?: number,
     *     QtyDeliverd_NotInvoiced?: number,
     *     ProductCode?: string,
     *     ProductBarcode1?: string,
     *     VATPercentage?: number,
     *     Notes?: string,
     *     DebtorId?: integer,
     *     OrderId?: integer,
     *     WarehouseId?: integer,
     *     Commission?: string,
     *     DeliveryOptionId?: integer,
     *     VatCodeId?: integer,
     *     VatCodeIdOverrule?: integer,
     *     FreeValue1?: string,
     *     FreeValue2?: string,
     *     FreeValue3?: string,
     *     FreeValue4?: string,
     *     FreeValue5?: string,
     *     ExpectedNextDelivery?: string,
     *     AgreedDeliveryDate?: string,
     *     Type1Id?: integer,
     *     Type2Id?: integer,
     *     Type3Id?: integer,
     *     Type4Id?: integer,
     *     Type5Id?: integer,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addUpdateOrderRow(array $parameters = []): Int32Logic4Response
    {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.1/Orders/AddUpdateOrderRow', ['json' => $parameters]),
            )
        );
    }

    /**
     * Maak en verwerk een factuur o.b.v. te factureren regels op een order.
     *
     * @throws Logic4ApiException
     */
    public function createAndProcessInvoiceForOrder(): Int32Logic4Response
    {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Orders/CreateAndProcessInvoiceForOrder'),
            )
        );
    }

    /**
     * Verkrijg factuurregels o.b.v. het meegestuurde filter.
     *
     * @param array{
     *     OrderId?: integer,
     *     BrandName?: string,
     *     LoadNextDeliveryDate?: boolean,
     *     ChangedAfter?: string,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getInvoiceRows(array $parameters = []): OrderRowLogic4ResponseList
    {
        return OrderRowLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Orders/GetInvoiceRows', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg facturen o.b.v. het meegestuurde filter.
     *
     * @param array{
     *     SkipRecords?: integer,
     *     TakeRecords?: integer,
     *     ChangedAfter?: string,
     *     Id?: integer,
     *     DebtorId?: integer,
     *     CreationDateFrom?: string,
     *     CreationDateTo?: string,
     *     Barcode1?: string,
     *     ProductCode?: string,
     *     Delivery_Address?: string,
     *     Delivery_PostalCode?: string,
     *     Delivery_City?: string,
     *     Delivery_ContactName?: string,
     *     Delivery_CompanyName?: string,
     *     Delivery_Email?: string,
     *     Invoice_Address?: string,
     *     Invoice_PostalCode?: string,
     *     Invoice_City?: string,
     *     Invoice_ContactName?: string,
     *     Invoice_CompanyName?: string,
     *     Invoice_Email?: string,
     *     LastActionFrom?: string,
     *     LastActionTo?: string,
     *     Reference?: string,
     *     LoadPayments?: boolean,
     *     StatusId?: integer,
     *     Type1Id?: integer,
     *     Type2Id?: integer,
     *     Type3Id?: integer,
     * } $parameters
     *
     * @return PaginatedResponse<\Webparking\Logic4Client\Data\Order>
     *
     * @throws Logic4ApiException
     */
    public function getInvoices(array $parameters = []): PaginatedResponse
    {
        return new PaginatedResponse(
            $this->paginateRecords('/v1.2/Orders/GetInvoices', $parameters),
            \Webparking\Logic4Client\Data\Order::class,
        );
    }

    /**
     * Verkrijg het nog te betalen bedrag van openstaande facturen.
     *
     * @param array{
     *     DebtorId?: integer,
     *     DateFrom?: string,
     *     DateTo?: string,
     *     DaysPastDueDate?: integer,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getOpenPaymentInvoices(
        array $parameters = [],
    ): InvoiceOpenPaymentLogic4ResponseList {
        return InvoiceOpenPaymentLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Orders/GetOpenPaymentInvoices', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg het nog te betalen bedrag van nog niet uitgeleverde orders.<br />
     * Indien historypoints zijn aangegeven, moet timeframe een van de volgende waarden hebben: ['Day', 'Week', 'Month', 'Quarter', 'Year'].
     *
     * @param array{
     *     SkipRecords?: integer,
     *     TakeRecords?: integer,
     *     TimeFrame?: string,
     *     HistoryPoints?: integer,
     *     OrderstatusIds?: array<integer>,
     *     WebsiteDomainIds?: array<integer>,
     *     NotLinkedToWebsiteDomain?: boolean,
     *     EmployeeIds?: array<integer>,
     *     BranchIds?: array<integer>,
     * } $parameters
     *
     * @return PaginatedResponse<OrderOpenPayment>
     *
     * @throws Logic4ApiException
     */
    public function getOpenPaymentOrders(array $parameters = []): PaginatedResponse
    {
        return new PaginatedResponse(
            $this->paginateRecords('/v1.1/Orders/GetOpenPaymentOrders', $parameters),
            OrderOpenPayment::class,
        );
    }

    /**
     * Verkrijg het nog te betalen bedrag van nog niet uitgeleverde orders in totalen.
     *
     * @param array{
     *     TimeFrame?: string,
     *     HistoryPoints?: integer,
     *     OrderstatusIds?: array<integer>,
     *     WebsiteDomainIds?: array<integer>,
     *     NotLinkedToWebsiteDomain?: boolean,
     *     EmployeeIds?: array<integer>,
     *     BranchIds?: array<integer>,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getOpenPaymentOrdersTotals(
        array $parameters = [],
    ): OrderOpenPaymentLogic4Response {
        return OrderOpenPaymentLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Orders/GetOpenPaymentOrdersTotals', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg acties die hebben plaatsgevonden op een order bv. het wijzigen van een betaalmethode.
     *
     * @param array{
     *     StartDateTime?: string,
     *     EndDateTime?: string,
     *     OrderId?: integer,
     *     TypeId?: integer,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getOrderActions(
        array $parameters = [],
    ): OrderActionLogic4ResponseList {
        return OrderActionLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Orders/GetOrderActions', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg alle order actietypes.
     *
     * @throws Logic4ApiException
     */
    public function getOrderActionsTypes(): OrderActionTypeLogic4ResponseList
    {
        return OrderActionTypeLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Orders/GetOrderActionsTypes'),
            )
        );
    }

    /**
     * Verkrijg order Id's o.b.v. het meegestuurde filter.
     *
     * @param array{
     *     OnlyCompleteForDelivery?: boolean,
     *     OnlyWithCompletePayment?: boolean,
     *     OrderStatus?: integer,
     *     Warehouses?: array<integer>,
     *     MustHaveQtyToDeliverNowAboveZero?: boolean,
     *     HasPickbon?: boolean,
     *     OnlyGetOrderIdsToCreatePickbonNow?: boolean,
     *     ChangedAfter?: string,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getOrderIds(array $parameters = []): Int32Logic4ResponseList
    {
        return Int32Logic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Orders/GetOrderIds', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg ordersregels o.b.v. het meegestuurde filter.
     *
     * @param array{
     *     OrderId?: integer,
     *     BrandName?: string,
     *     LoadNextDeliveryDate?: boolean,
     *     ChangedAfter?: string,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getOrderRows(array $parameters = []): OrderRowLogic4ResponseList
    {
        return OrderRowLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Orders/GetOrderRows', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg orders o.b.v. het meegestuurde filter.
     *
     * @param array{
     *     SkipRecords?: integer,
     *     TakeRecords?: integer,
     *     ChangedAfter?: string,
     *     Id?: integer,
     *     DebtorId?: integer,
     *     CreationDateFrom?: string,
     *     CreationDateTo?: string,
     *     Barcode1?: string,
     *     ProductCode?: string,
     *     Delivery_Address?: string,
     *     Delivery_PostalCode?: string,
     *     Delivery_City?: string,
     *     Delivery_ContactName?: string,
     *     Delivery_CompanyName?: string,
     *     Delivery_Email?: string,
     *     Invoice_Address?: string,
     *     Invoice_PostalCode?: string,
     *     Invoice_City?: string,
     *     Invoice_ContactName?: string,
     *     Invoice_CompanyName?: string,
     *     Invoice_Email?: string,
     *     LastActionFrom?: string,
     *     LastActionTo?: string,
     *     Reference?: string,
     *     LoadPayments?: boolean,
     *     StatusId?: integer,
     *     Type1Id?: integer,
     *     Type2Id?: integer,
     *     Type3Id?: integer,
     * } $parameters
     *
     * @return PaginatedResponse<\Webparking\Logic4Client\Data\Order>
     *
     * @throws Logic4ApiException
     */
    public function getOrders(array $parameters = []): PaginatedResponse
    {
        return new PaginatedResponse(
            $this->paginateRecords('/v1.2/Orders/GetOrders', $parameters),
            \Webparking\Logic4Client\Data\Order::class,
        );
    }

    /**
     * Haal alle orderstatussen op.
     *
     * @throws Logic4ApiException
     */
    public function getOrderStatuses(): OrderStatusLogic4ResponseList
    {
        return OrderStatusLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Orders/GetOrderStatuses'),
            )
        );
    }

    /**
     * Verkrijg alle order retourcategorieën.
     *
     * @throws Logic4ApiException
     */
    public function getReturnCategories(): ReturnCategoryLogic4ResponseList
    {
        return ReturnCategoryLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Orders/GetReturnCategories'),
            )
        );
    }

    /**
     * Verkrijg retourorders o.b.v. het meegestuurde filter.
     *
     * @param array{
     *     SolutionId?: integer,
     *     ProblemId?: integer,
     *     CategoryId?: integer,
     *     BelongsToOrderId?: integer,
     *     Id?: integer,
     *     DebtorId?: integer,
     *     CreationDateFrom?: string,
     *     CreationDateTo?: string,
     *     Barcode1?: string,
     *     ProductCode?: string,
     *     Delivery_Address?: string,
     *     Delivery_PostalCode?: string,
     *     Delivery_City?: string,
     *     Delivery_ContactName?: string,
     *     Delivery_CompanyName?: string,
     *     Delivery_Email?: string,
     *     Invoice_Address?: string,
     *     Invoice_PostalCode?: string,
     *     Invoice_City?: string,
     *     Invoice_ContactName?: string,
     *     Invoice_CompanyName?: string,
     *     Invoice_Email?: string,
     *     LastActionFrom?: string,
     *     LastActionTo?: string,
     *     Reference?: string,
     *     LoadPayments?: boolean,
     *     StatusId?: integer,
     *     Type1Id?: integer,
     *     Type2Id?: integer,
     *     Type3Id?: integer,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getReturnOrders(array $parameters = []): OrderLogic4ResponseList
    {
        return OrderLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.1/Orders/GetReturnOrders', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg retourproblemen o.b.v. het filter.
     *
     * @param array{
     *     SkipRecords?: integer,
     *     TakeRecords?: integer,
     * } $parameters
     *
     * @return PaginatedResponse<ReturnProblem>
     *
     * @throws Logic4ApiException
     */
    public function getReturnProblems(array $parameters = []): PaginatedResponse
    {
        return new PaginatedResponse(
            $this->paginateRecords('/v1.1/Orders/GetReturnProblems', $parameters),
            ReturnProblem::class,
        );
    }

    /**
     * Verkrijg order retouroplossingen o.b.v. het filter.
     *
     * @param array{
     *     SkipRecords?: integer,
     *     TakeRecords?: integer,
     * } $parameters
     *
     * @return PaginatedResponse<ReturnSolution>
     *
     * @throws Logic4ApiException
     */
    public function getReturnSolutions(array $parameters = []): PaginatedResponse
    {
        return new PaginatedResponse(
            $this->paginateRecords('/v1.1/Orders/GetReturnSolutions', $parameters),
            ReturnSolution::class,
        );
    }

    /**
     * @throws Logic4ApiException
     */
    public function getSerialnumberTypes(): OrderLogic4ResponseList
    {
        return OrderLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Orders/GetSerialnumberTypes'),
            )
        );
    }

    /**
     * Voorzie orderregels met een afgesproken afleverdatum.
     *
     * @throws Logic4ApiException
     */
    public function updateAgreedDeliveryDatesForOrderRows(): BooleanLogic4Response
    {
        return BooleanLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Orders/UpdateAgreedDeliveryDatesForOrderRows'),
            )
        );
    }

    /**
     * Wijzig het contactadres van een order of factuur o.b.v. de meegestuurde gegevens.
     *
     * @param array{
     *     OrderId?: integer,
     *     InvoiceId?: integer,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function updateContactAddressForOrderOrInvoice(
        array $parameters = [],
    ): Int32Logic4Response {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.1/Orders/UpdateContactAddressForOrderOrInvoice', ['json' => $parameters]),
            )
        );
    }

    /**
     * Wijzig het afleveradres van een order of factuur o.b.v. de meegestuurde gegevens.
     *
     * @param array{
     *     OrderId?: integer,
     *     InvoiceId?: integer,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function updateDeliveryAddressForOrderOrInvoice(
        array $parameters = [],
    ): Int32Logic4Response {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.1/Orders/UpdateDeliveryAddressForOrderOrInvoice', ['json' => $parameters]),
            )
        );
    }

    /**
     * Wijzig het factuuradres van een order of factuur o.b.v. de meegestuurde gegevens.
     *
     * @param array{
     *     OrderId?: integer,
     *     InvoiceId?: integer,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function updateInvoiceAddressForOrderOrInvoice(
        array $parameters = [],
    ): Int32Logic4Response {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.1/Orders/UpdateInvoiceAddressForOrderOrInvoice', ['json' => $parameters]),
            )
        );
    }

    /**
     * Update de status van een order.
     *
     * @param array{
     *     StatusId?: integer,
     *     OrderId?: integer,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function updateOrderStatus(array $parameters = []): BooleanLogic4Response
    {
        return BooleanLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Orders/UpdateOrderStatus', ['json' => $parameters]),
            )
        );
    }
}
