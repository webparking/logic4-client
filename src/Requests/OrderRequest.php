<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests;

use Webparking\Logic4Client\Data\Order;
use Webparking\Logic4Client\Data\OrderOpenPayment;
use Webparking\Logic4Client\Data\ReturnProblem;
use Webparking\Logic4Client\Data\ReturnSolution;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
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

class OrderRequest extends Request
{
    /**
     * @param array{
     *     SerialNumberTypeId?: integer|null,
     *     OrderRowSerialNumbers?: array<array{SerialNumber?: string, OrderRowId?: integer}>|null,
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
     *     OrderId?: integer|null,
     *     InvoiceId?: integer|null,
     *     AmountIncl?: number|null,
     *     Description?: string|null,
     *     BookingId?: integer|null,
     *     MatchingLedgerId?: integer|null,
     *     DateTime?: string|null,
     *     LedgerCode?: integer|null,
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
     *     CheckForOrderCostAndPaymentRegulation?: boolean|null,
     *     DebtorId?: integer|null,
     *     Id?: integer|null,
     *     OrderRows?: array<array{OrderRowWithProductComposition?: array{AddProductCompositionByParentProductToOrder?: boolean, UseSystemPricesForProductCompositionProducts?: boolean}, InclPrice?: number, GrossInclPrice?: number, Id?: integer, Description?: string, Description2?: string, ProductId?: integer, Qty?: number, BuyPrice?: number, GrossPrice?: number, NettPrice?: number, QtyDeliverd?: number, QtyDeliverd_NotInvoiced?: number, ProductCode?: string, ProductBarcode1?: string, VATPercentage?: number, Notes?: string, DebtorId?: integer, OrderId?: integer, WarehouseId?: integer, Commission?: string, DeliveryOptionId?: integer, VatCodeId?: integer, VatCodeIdOverrule?: integer, FreeValue1?: string, FreeValue2?: string, FreeValue3?: string, FreeValue4?: string, FreeValue5?: string, ExpectedNextDelivery?: string, ExternalValue?: array{TypeId?: integer, Value?: string}, AgreedDeliveryDate?: string, Type1Id?: integer, Type2Id?: integer, Type3Id?: integer, Type4Id?: integer, Type5Id?: integer}>|null,
     *     AcceptTermsAndConditions?: boolean|null,
     *     CreationDate?: string|null,
     *     Description?: string|null,
     *     Reference?: string|null,
     *     BranchId?: integer|null,
     *     UserId?: integer|null,
     *     WebsiteDomainId?: integer|null,
     *     DeliveryOptionId?: integer|null,
     *     DeliveryDate?: string|null,
     *     Notes?: string|null,
     *     FreeValue1?: string|null,
     *     FreeValue2?: string|null,
     *     FreeValue3?: string|null,
     *     FreeValue4?: string|null,
     *     FreeValue5?: string|null,
     *     FreeValue6?: string|null,
     *     FreeValue7?: string|null,
     *     FreeValue8?: string|null,
     *     OrderType1Id?: integer|null,
     *     OrderType2Id?: integer|null,
     *     OrderType3Id?: integer|null,
     *     OrderType4Id?: integer|null,
     *     OrderType5Id?: integer|null,
     *     OrderType6Id?: integer|null,
     *     OrderType7Id?: integer|null,
     *     OrderType8Id?: integer|null,
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
     *     CheckForOrderCostAndPaymentRegulation?: boolean|null,
     *     DebtorId?: integer|null,
     *     Id?: integer|null,
     *     OrderRows?: array<array{OrderRowWithProductComposition?: array{AddProductCompositionByParentProductToOrder?: boolean, UseSystemPricesForProductCompositionProducts?: boolean}, InclPrice?: number, GrossInclPrice?: number, Id?: integer, Description?: string, Description2?: string, ProductId?: integer, Qty?: number, BuyPrice?: number, GrossPrice?: number, NettPrice?: number, QtyDeliverd?: number, QtyDeliverd_NotInvoiced?: number, ProductCode?: string, ProductBarcode1?: string, VATPercentage?: number, Notes?: string, DebtorId?: integer, OrderId?: integer, WarehouseId?: integer, Commission?: string, DeliveryOptionId?: integer, VatCodeId?: integer, VatCodeIdOverrule?: integer, FreeValue1?: string, FreeValue2?: string, FreeValue3?: string, FreeValue4?: string, FreeValue5?: string, ExpectedNextDelivery?: string, ExternalValue?: array{TypeId?: integer, Value?: string}, AgreedDeliveryDate?: string, Type1Id?: integer, Type2Id?: integer, Type3Id?: integer, Type4Id?: integer, Type5Id?: integer}>|null,
     *     AcceptTermsAndConditions?: boolean|null,
     *     CreationDate?: string|null,
     *     Description?: string|null,
     *     Reference?: string|null,
     *     BranchId?: integer|null,
     *     UserId?: integer|null,
     *     WebsiteDomainId?: integer|null,
     *     DeliveryOptionId?: integer|null,
     *     DeliveryDate?: string|null,
     *     Notes?: string|null,
     *     FreeValue1?: string|null,
     *     FreeValue2?: string|null,
     *     FreeValue3?: string|null,
     *     FreeValue4?: string|null,
     *     FreeValue5?: string|null,
     *     FreeValue6?: string|null,
     *     FreeValue7?: string|null,
     *     FreeValue8?: string|null,
     *     OrderType1Id?: integer|null,
     *     OrderType2Id?: integer|null,
     *     OrderType3Id?: integer|null,
     *     OrderType4Id?: integer|null,
     *     OrderType5Id?: integer|null,
     *     OrderType6Id?: integer|null,
     *     OrderType7Id?: integer|null,
     *     OrderType8Id?: integer|null,
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
     *     InclPrice?: number|null,
     *     GrossInclPrice?: number|null,
     *     Id?: integer|null,
     *     Description?: string|null,
     *     Description2?: string|null,
     *     ProductId?: integer|null,
     *     Qty?: number|null,
     *     BuyPrice?: number|null,
     *     GrossPrice?: number|null,
     *     NettPrice?: number|null,
     *     QtyDeliverd?: number|null,
     *     QtyDeliverd_NotInvoiced?: number|null,
     *     ProductCode?: string|null,
     *     ProductBarcode1?: string|null,
     *     VATPercentage?: number|null,
     *     Notes?: string|null,
     *     DebtorId?: integer|null,
     *     OrderId?: integer|null,
     *     WarehouseId?: integer|null,
     *     Commission?: string|null,
     *     DeliveryOptionId?: integer|null,
     *     VatCodeId?: integer|null,
     *     VatCodeIdOverrule?: integer|null,
     *     FreeValue1?: string|null,
     *     FreeValue2?: string|null,
     *     FreeValue3?: string|null,
     *     FreeValue4?: string|null,
     *     FreeValue5?: string|null,
     *     ExpectedNextDelivery?: string|null,
     *     AgreedDeliveryDate?: string|null,
     *     Type1Id?: integer|null,
     *     Type2Id?: integer|null,
     *     Type3Id?: integer|null,
     *     Type4Id?: integer|null,
     *     Type5Id?: integer|null,
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
    public function createAndProcessInvoiceForOrder(int $value): Int32Logic4Response
    {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Orders/CreateAndProcessInvoiceForOrder', ['json' => $value]),
            )
        );
    }

    /**
     * Verkrijg factuurregels o.b.v. het meegestuurde filter.
     *
     * @param array{
     *     OrderId?: integer|null,
     *     BrandName?: string|null,
     *     LoadNextDeliveryDate?: boolean|null,
     *     ChangedAfter?: string|null,
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
     *     SkipRecords?: integer|null,
     *     TakeRecords?: integer|null,
     *     ChangedAfter?: string|null,
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
     * @return \Generator<array-key, Order>
     *
     * @throws Logic4ApiException
     */
    public function getInvoices(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1.2/Orders/GetInvoices', $parameters);

        foreach ($iterator as $record) {
            yield Order::make($record);
        }
    }

    /**
     * Verkrijg het nog te betalen bedrag van openstaande facturen.
     *
     * @param array{
     *     DebtorId?: integer|null,
     *     DateFrom?: string|null,
     *     DateTo?: string|null,
     *     DaysPastDueDate?: integer|null,
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
     *     SkipRecords?: integer|null,
     *     TakeRecords?: integer|null,
     *     TimeFrame?: string|null,
     *     HistoryPoints?: integer|null,
     *     OrderstatusIds?: array<integer>|null,
     *     WebsiteDomainIds?: array<integer>|null,
     *     NotLinkedToWebsiteDomain?: boolean|null,
     *     EmployeeIds?: array<integer>|null,
     *     BranchIds?: array<integer>|null,
     * } $parameters
     *
     * @return \Generator<array-key, OrderOpenPayment>
     *
     * @throws Logic4ApiException
     */
    public function getOpenPaymentOrders(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1.1/Orders/GetOpenPaymentOrders', $parameters);

        foreach ($iterator as $record) {
            yield OrderOpenPayment::make($record);
        }
    }

    /**
     * Verkrijg het nog te betalen bedrag van nog niet uitgeleverde orders in totalen.
     *
     * @param array{
     *     TimeFrame?: string|null,
     *     HistoryPoints?: integer|null,
     *     OrderstatusIds?: array<integer>|null,
     *     WebsiteDomainIds?: array<integer>|null,
     *     NotLinkedToWebsiteDomain?: boolean|null,
     *     EmployeeIds?: array<integer>|null,
     *     BranchIds?: array<integer>|null,
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
     *     StartDateTime?: string|null,
     *     EndDateTime?: string|null,
     *     OrderId?: integer|null,
     *     TypeId?: integer|null,
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
     *     OnlyCompleteForDelivery?: boolean|null,
     *     OnlyWithCompletePayment?: boolean|null,
     *     OrderStatus?: integer|null,
     *     Warehouses?: array<integer>|null,
     *     MustHaveQtyToDeliverNowAboveZero?: boolean|null,
     *     HasPickbon?: boolean|null,
     *     OnlyGetOrderIdsToCreatePickbonNow?: boolean|null,
     *     ChangedAfter?: string|null,
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
     *     OrderId?: integer|null,
     *     BrandName?: string|null,
     *     LoadNextDeliveryDate?: boolean|null,
     *     ChangedAfter?: string|null,
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
     *     SkipRecords?: integer|null,
     *     TakeRecords?: integer|null,
     *     ChangedAfter?: string|null,
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
     * @return \Generator<array-key, Order>
     *
     * @throws Logic4ApiException
     */
    public function getOrders(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1.2/Orders/GetOrders', $parameters);

        foreach ($iterator as $record) {
            yield Order::make($record);
        }
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
     *     SkipRecords?: integer|null,
     *     TakeRecords?: integer|null,
     * } $parameters
     *
     * @return \Generator<array-key, ReturnProblem>
     *
     * @throws Logic4ApiException
     */
    public function getReturnProblems(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1.1/Orders/GetReturnProblems', $parameters);

        foreach ($iterator as $record) {
            yield ReturnProblem::make($record);
        }
    }

    /**
     * Verkrijg order retouroplossingen o.b.v. het filter.
     *
     * @param array{
     *     SkipRecords?: integer|null,
     *     TakeRecords?: integer|null,
     * } $parameters
     *
     * @return \Generator<array-key, ReturnSolution>
     *
     * @throws Logic4ApiException
     */
    public function getReturnSolutions(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1.1/Orders/GetReturnSolutions', $parameters);

        foreach ($iterator as $record) {
            yield ReturnSolution::make($record);
        }
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
     * @param array<array{
     *     RowId?: integer|null,
     *     AgreedDeliveryDate?: string|null,
     * }> $parameters
     *
     * @throws Logic4ApiException
     */
    public function updateAgreedDeliveryDatesForOrderRows(
        array $parameters = [],
    ): BooleanLogic4Response {
        return BooleanLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Orders/UpdateAgreedDeliveryDatesForOrderRows', ['json' => $parameters]),
            )
        );
    }

    /**
     * Wijzig het contactadres van een order of factuur o.b.v. de meegestuurde gegevens.
     *
     * @param array{
     *     OrderId?: integer|null,
     *     InvoiceId?: integer|null,
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
     *     OrderId?: integer|null,
     *     InvoiceId?: integer|null,
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
     *     OrderId?: integer|null,
     *     InvoiceId?: integer|null,
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
     *     StatusId?: integer|null,
     *     OrderId?: integer|null,
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
