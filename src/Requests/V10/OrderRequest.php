<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V10;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V10\BooleanLogic4Response;
use Webparking\Logic4Client\Responses\V10\Int32Logic4Response;
use Webparking\Logic4Client\Responses\V10\Int32Logic4ResponseList;
use Webparking\Logic4Client\Responses\V10\InvoiceOpenPaymentLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\OrderActionLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\OrderActionTypeLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\OrderLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\OrderOpenPaymentLogic4Response;
use Webparking\Logic4Client\Responses\V10\OrderOpenPaymentLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\OrderRowLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\OrderRowV11Logic4ResponseList;
use Webparking\Logic4Client\Responses\V10\OrderStatusLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\ReturnCategoryLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\ReturnProblemLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\ReturnSolutionLogic4ResponseList;

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
     *     CustomerThirdPartyExternalIdentifer?: array{DebtorId?: integer, TypeId?: integer, Value?: string}|null,
     *     Id?: integer|null,
     *     PaymentMethod?: array{Id?: integer, Description?: string, MaxAmount?: number, SelectKey?: string}|null,
     *     ShippingMethod?: array{Id?: integer, Name?: string, ExportCode?: string}|null,
     *     Totals?: array{AmountEx?: number, VATPercentage?: number, Calc_TotalPayed?: number, AmountIncl?: number, IsPaid?: boolean, ShippingCost?: number, ShippingCostIncl?: number}|null,
     *     OrderStatus?: array{Id?: integer, Value?: string}|null,
     *     OrderRows?: array<array{OrderRowWithProductComposition?: array{AddProductCompositionByParentProductToOrder?: boolean, UseSystemPricesForProductCompositionProducts?: boolean}, InclPrice?: number, GrossInclPrice?: number, Id?: integer, Description?: string, Description2?: string, ProductId?: integer, Qty?: number, BuyPrice?: number, GrossPrice?: number, NettPrice?: number, QtyDeliverd?: number, QtyDeliverd_NotInvoiced?: number, ProductCode?: string, ProductBarcode1?: string, VATPercentage?: number, Notes?: string, DebtorId?: integer, OrderId?: integer, WarehouseId?: integer, Commission?: string, DeliveryOptionId?: integer, VatCodeId?: integer, VatCodeIdOverrule?: integer, FreeValue1?: string, FreeValue2?: string, FreeValue3?: string, FreeValue4?: string, FreeValue5?: string, ExpectedNextDelivery?: string, ExternalValue?: array{TypeId?: integer, Value?: string}, AgreedDeliveryDate?: string, Type1Id?: integer, Type2Id?: integer, Type3Id?: integer, Type4Id?: integer, Type5Id?: integer}>|null,
     *     AcceptTermsAndConditions?: boolean|null,
     *     DeliveryAddress?: array{Type?: array{Id?: integer, Name?: string}, Province?: array{Id?: integer, Name?: string}, Email?: string, ContactName?: string, CompanyName?: string, Address1?: string, Address2?: string, Id?: integer, DebtorId?: integer, CreditorId?: integer, IsMainContact?: boolean, IsHidden?: boolean, OwnContactNumber?: string, CountryCode?: string, IsoCode?: string, City?: string, Zipcode?: string, Street?: string, HouseNumber?: string, HouseNumberAddition?: string, TelephoneNumber?: string, CountryId?: integer, ZoneId?: integer}|null,
     *     InvoiceAddress?: array{Type?: array{Id?: integer, Name?: string}, Province?: array{Id?: integer, Name?: string}, Email?: string, ContactName?: string, CompanyName?: string, Address1?: string, Address2?: string, Id?: integer, DebtorId?: integer, CreditorId?: integer, IsMainContact?: boolean, IsHidden?: boolean, OwnContactNumber?: string, CountryCode?: string, IsoCode?: string, City?: string, Zipcode?: string, Street?: string, HouseNumber?: string, HouseNumberAddition?: string, TelephoneNumber?: string, CountryId?: integer, ZoneId?: integer}|null,
     *     CreationDate?: string|null,
     *     Description?: string|null,
     *     Reference?: string|null,
     *     BranchId?: integer|null,
     *     UserId?: integer|null,
     *     WebsiteDomainId?: integer|null,
     *     DeliveryOptionId?: integer|null,
     *     DeliveryDate?: string|null,
     *     OrderShipmentFreeValues?: array{ShipperTypeId?: integer, Freevalue1?: string, Freevalue2?: string, Freevalue3?: string, Freevalue4?: string, Freevalue5?: string}|null,
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
     *
     * @deprecated Let op! Versie 1.0 is verouderd. Gebruik versie v1.3. - Factuur toevoegen of updaten
     */
    public function addUpdateInvoice(array $parameters = []): Int32Logic4Response
    {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Orders/AddUpdateInvoice', ['json' => $parameters]),
            )
        );
    }

    /**
     * Wijzig of maak een nieuwe order aan, het is alleen mogelijk om stamgegevens van een order te updaten (status, NAW, betaal/verzendmethode).
     * Orderregels kunnen slechts eenmalig bij het aanmaken van de order gevuld worden.
     * Bij het succesvol aanmaken/updaten wordt het (nieuwe) ordernummer in de response gevuld.
     *
     * @param array{
     *     CheckForOrderCostAndPaymentRegulation?: boolean|null,
     *     DebtorId?: integer|null,
     *     CustomerThirdPartyExternalIdentifer?: array{DebtorId?: integer, TypeId?: integer, Value?: string}|null,
     *     Id?: integer|null,
     *     PaymentMethod?: array{Id?: integer, Description?: string, MaxAmount?: number, SelectKey?: string}|null,
     *     ShippingMethod?: array{Id?: integer, Name?: string, ExportCode?: string}|null,
     *     Totals?: array{AmountEx?: number, VATPercentage?: number, Calc_TotalPayed?: number, AmountIncl?: number, IsPaid?: boolean, ShippingCost?: number, ShippingCostIncl?: number}|null,
     *     OrderStatus?: array{Id?: integer, Value?: string}|null,
     *     OrderRows?: array<array{OrderRowWithProductComposition?: array{AddProductCompositionByParentProductToOrder?: boolean, UseSystemPricesForProductCompositionProducts?: boolean}, InclPrice?: number, GrossInclPrice?: number, Id?: integer, Description?: string, Description2?: string, ProductId?: integer, Qty?: number, BuyPrice?: number, GrossPrice?: number, NettPrice?: number, QtyDeliverd?: number, QtyDeliverd_NotInvoiced?: number, ProductCode?: string, ProductBarcode1?: string, VATPercentage?: number, Notes?: string, DebtorId?: integer, OrderId?: integer, WarehouseId?: integer, Commission?: string, DeliveryOptionId?: integer, VatCodeId?: integer, VatCodeIdOverrule?: integer, FreeValue1?: string, FreeValue2?: string, FreeValue3?: string, FreeValue4?: string, FreeValue5?: string, ExpectedNextDelivery?: string, ExternalValue?: array{TypeId?: integer, Value?: string}, AgreedDeliveryDate?: string, Type1Id?: integer, Type2Id?: integer, Type3Id?: integer, Type4Id?: integer, Type5Id?: integer}>|null,
     *     AcceptTermsAndConditions?: boolean|null,
     *     DeliveryAddress?: array{Type?: array{Id?: integer, Name?: string}, Province?: array{Id?: integer, Name?: string}, Email?: string, ContactName?: string, CompanyName?: string, Address1?: string, Address2?: string, Id?: integer, DebtorId?: integer, CreditorId?: integer, IsMainContact?: boolean, IsHidden?: boolean, OwnContactNumber?: string, CountryCode?: string, IsoCode?: string, City?: string, Zipcode?: string, Street?: string, HouseNumber?: string, HouseNumberAddition?: string, TelephoneNumber?: string, CountryId?: integer, ZoneId?: integer}|null,
     *     InvoiceAddress?: array{Type?: array{Id?: integer, Name?: string}, Province?: array{Id?: integer, Name?: string}, Email?: string, ContactName?: string, CompanyName?: string, Address1?: string, Address2?: string, Id?: integer, DebtorId?: integer, CreditorId?: integer, IsMainContact?: boolean, IsHidden?: boolean, OwnContactNumber?: string, CountryCode?: string, IsoCode?: string, City?: string, Zipcode?: string, Street?: string, HouseNumber?: string, HouseNumberAddition?: string, TelephoneNumber?: string, CountryId?: integer, ZoneId?: integer}|null,
     *     CreationDate?: string|null,
     *     Description?: string|null,
     *     Reference?: string|null,
     *     BranchId?: integer|null,
     *     UserId?: integer|null,
     *     WebsiteDomainId?: integer|null,
     *     DeliveryOptionId?: integer|null,
     *     DeliveryDate?: string|null,
     *     OrderShipmentFreeValues?: array{ShipperTypeId?: integer, Freevalue1?: string, Freevalue2?: string, Freevalue3?: string, Freevalue4?: string, Freevalue5?: string}|null,
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
     *
     * @deprecated Let op! Versie 1.0 is verouderd. Gebruik versie v1.3. - Order toevoegen of updaten
     */
    public function addUpdateOrder(array $parameters = []): Int32Logic4Response
    {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Orders/AddUpdateOrder', ['json' => $parameters]),
            )
        );
    }

    /**
     * Voeg een nieuwe orderregel toe of update een bestaande. Om een bestaande te updaten dient het veld 'Id' gevuld te zijn met een bestaand orderregelnummer.
     *
     * @param array{
     *     OrderRowWithProductComposition?: array{AddProductCompositionByParentProductToOrder?: boolean, UseSystemPricesForProductCompositionProducts?: boolean}|null,
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
     *     ExternalValue?: array{TypeId?: integer, Value?: string}|null,
     *     AgreedDeliveryDate?: string|null,
     *     Type1Id?: integer|null,
     *     Type2Id?: integer|null,
     *     Type3Id?: integer|null,
     *     Type4Id?: integer|null,
     *     Type5Id?: integer|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     *
     * @deprecated Let op! Versie 1.0 is verouderd. Gebruik versie v1.1. - Update gegevens van een orderregel
     */
    public function addUpdateOrderRow(array $parameters = []): Int32Logic4Response
    {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Orders/AddUpdateOrderRow', ['json' => $parameters]),
            )
        );
    }

    /**
     * Maak en verwerk een factuur o.b.v. te factureren regels op een order.
     * Geef als argument de Id van de order.
     *
     * @throws Logic4ApiException
     */
    public function createAndProcessInvoiceForOrder(
        int $value,
    ): Int32Logic4Response {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Orders/CreateAndProcessInvoiceForOrder', ['json' => $value]),
            )
        );
    }

    /**
     * Een nieuwe retouropdracht aanmaken, het is alleen mogelijk om een retouropdracht aan te maken voor een bestaande order.
     * Alle details van de retouropdracht (OriginalOrderId, ProblemId, SolutionId, ReceivedReturnOrderDate) moeten geldig zijn.
     * Specificeer een negatieve waarde voor Qty in elke orderregel. Bij het succesvol aanmaken bevat de response het nummer van de retourorder.
     *
     * @param array{
     *     Totals?: array{AmountEx?: number, VATPercentage?: number, Calc_TotalPayed?: number, AmountIncl?: number, IsPaid?: boolean, ShippingCost?: number, ShippingCostIncl?: number}|null,
     *     OriginalOrderId?: integer|null,
     *     OriginalOrderDate?: string|null,
     *     OriginalOrderZipCode?: string|null,
     *     ProblemId?: integer|null,
     *     SolutionId?: integer|null,
     *     ReceivedReturnOrderDate?: string|null,
     *     ApprovedReturnOrderDate?: string|null,
     *     DebtorId?: integer|null,
     *     CustomerThirdPartyExternalIdentifer?: array{DebtorId?: integer, TypeId?: integer, Value?: string}|null,
     *     Id?: integer|null,
     *     PaymentMethod?: array{Id?: integer, Description?: string, MaxAmount?: number, SelectKey?: string}|null,
     *     ShippingMethod?: array{Id?: integer, Name?: string, ExportCode?: string}|null,
     *     CheckForOrderCostAndPaymentRegulation?: boolean|null,
     *     OrderStatus?: array{Id?: integer, Value?: string}|null,
     *     OrderRows?: array<array{OrderRowWithProductComposition?: array{AddProductCompositionByParentProductToOrder?: boolean, UseSystemPricesForProductCompositionProducts?: boolean}, InclPrice?: number, GrossInclPrice?: number, Id?: integer, Description?: string, Description2?: string, ProductId?: integer, Qty?: number, BuyPrice?: number, GrossPrice?: number, NettPrice?: number, QtyDeliverd?: number, QtyDeliverd_NotInvoiced?: number, ProductCode?: string, ProductBarcode1?: string, VATPercentage?: number, Notes?: string, DebtorId?: integer, OrderId?: integer, WarehouseId?: integer, Commission?: string, DeliveryOptionId?: integer, VatCodeId?: integer, VatCodeIdOverrule?: integer, FreeValue1?: string, FreeValue2?: string, FreeValue3?: string, FreeValue4?: string, FreeValue5?: string, ExpectedNextDelivery?: string, ExternalValue?: array{TypeId?: integer, Value?: string}, AgreedDeliveryDate?: string, Type1Id?: integer, Type2Id?: integer, Type3Id?: integer, Type4Id?: integer, Type5Id?: integer}>|null,
     *     AcceptTermsAndConditions?: boolean|null,
     *     DeliveryAddress?: array{TelephoneNumber?: string, Email?: string, Street2?: string, HouseNumber2?: string, HouseNumberAddition2?: string, Id?: integer, ProvinceId?: integer, ContactName?: string, CompanyName?: string, PostalCode?: string, City?: string, CountryCode?: string, Street?: string, HouseNumber?: string, HouseNumberAddition?: string}|null,
     *     InvoiceAddress?: array{Id?: integer, ProvinceId?: integer, ContactName?: string, CompanyName?: string, PostalCode?: string, City?: string, CountryCode?: string, Street?: string, HouseNumber?: string, HouseNumberAddition?: string}|null,
     *     CreationDate?: string|null,
     *     Description?: string|null,
     *     Reference?: string|null,
     *     BranchId?: integer|null,
     *     UserId?: integer|null,
     *     WebsiteDomainId?: integer|null,
     *     DeliveryOptionId?: integer|null,
     *     DeliveryDate?: string|null,
     *     OrderShipmentFreeValues?: array{ShipperTypeId?: integer, Freevalue1?: string, Freevalue2?: string, Freevalue3?: string, Freevalue4?: string, Freevalue5?: string}|null,
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
     *
     * @deprecated Let op! Versie 1.0 is verouderd. Gebruik versie v1.1. - Retourorders toevoegen
     */
    public function createReturnOrder(array $parameters = []): Int32Logic4Response
    {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Orders/CreateReturnOrder', ['json' => $parameters]),
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
    public function getInvoiceRows(
        array $parameters = [],
    ): OrderRowLogic4ResponseList {
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
     *
     * @deprecated Let op! Versie 1.0 is verouderd. Gebruik versie v1.2. - Facturen ophalen
     */
    public function getInvoices(array $parameters = []): OrderLogic4ResponseList
    {
        return OrderLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Orders/GetInvoices', ['json' => $parameters]),
            )
        );
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
     * Verkrijg het nog te betalen bedrag van nog niet uitgeleverde orders.
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
     *
     * @deprecated Let op! Versie 1.0 is verouderd. Gebruik versie v1.1. - Openstaande bedragen niet uitgeleverde orders ophalen
     */
    public function getOpenPaymentOrders(
        array $parameters = [],
    ): OrderOpenPaymentLogic4ResponseList {
        return OrderOpenPaymentLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Orders/GetOpenPaymentOrders', ['json' => $parameters]),
            )
        );
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
    public function getOrderRows(
        array $parameters = [],
    ): OrderRowV11Logic4ResponseList {
        return OrderRowV11Logic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Orders/GetOrderRows', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg orders o.b.v. het meegestuurde filter.
     *
     * @param array{
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
     *
     * @deprecated Let op! Versie 1.0 is verouderd. Gebruik versie v1.2. - Orders ophalen
     */
    public function getOrders(array $parameters = []): OrderLogic4ResponseList
    {
        return OrderLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Orders/GetOrders', ['json' => $parameters]),
            )
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
     *
     * @deprecated Let op! Versie 1.0 is verouderd. Gebruik versie v2.0. - Retourorders ophalen
     */
    public function getReturnOrders(
        array $parameters = [],
    ): OrderLogic4ResponseList {
        return OrderLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Orders/GetReturnOrders', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg alle order retourproblemen.
     *
     * @throws Logic4ApiException
     *
     * @deprecated Let op! Versie 1.0 is verouderd. Gebruik versie v1.1. - Order retourproblemen
     */
    public function getReturnProblems(): ReturnProblemLogic4ResponseList
    {
        return ReturnProblemLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Orders/GetReturnProblems'),
            )
        );
    }

    /**
     * Verkrijg alle order retouroplossingen.
     *
     * @throws Logic4ApiException
     *
     * @deprecated Let op! Versie 1.0 is verouderd. Gebruik versie v1.1. - Order retouroplossingen
     */
    public function getReturnSolutions(): ReturnSolutionLogic4ResponseList
    {
        return ReturnSolutionLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Orders/GetReturnSolutions'),
            )
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
     * Maakt een factuur aan, werkt voorraadmutaties bij, maakt financiële boekingen voor kosten en omzet aan,
     * zet het bedrag van de order naar de de factuur en zet de factuur op gesloten.
     * Geef als argument de Id van de factuur.
     *
     * @throws Logic4ApiException
     */
    public function processInvoice(int $value): Int32Logic4Response
    {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Orders/ProcessInvoice', ['json' => $value]),
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
     *     ContactAddress?: array{ProvinceId?: integer, ContactName?: string, CompanyName?: string, Address1?: string, PostalCode?: string, City?: string, CountryCode?: string}|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     *
     * @deprecated Let op! Versie 1.0 is verouderd. Gebruik versie v1.1. - Contactadres wijzigen van een order of factuur
     */
    public function updateContactAddressForOrderOrInvoice(
        array $parameters = [],
    ): Int32Logic4Response {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Orders/UpdateContactAddressForOrderOrInvoice', ['json' => $parameters]),
            )
        );
    }

    /**
     * Wijzig het afleveradres van een order of factuur o.b.v. de meegestuurde gegevens.
     *
     * @param array{
     *     OrderId?: integer|null,
     *     InvoiceId?: integer|null,
     *     DeliveryAddress?: array{Address2?: string, TelephoneNumber?: string, Email?: string, ProvinceId?: integer, ContactName?: string, CompanyName?: string, Address1?: string, PostalCode?: string, City?: string, CountryCode?: string}|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     *
     * @deprecated Let op! Versie 1.0 is verouderd. Gebruik versie v1.1. - Afleveradres wijzigen van een order of factuur
     */
    public function updateDeliveryAddressForOrderOrInvoice(
        array $parameters = [],
    ): Int32Logic4Response {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Orders/UpdateDeliveryAddressForOrderOrInvoice', ['json' => $parameters]),
            )
        );
    }

    /**
     * Wijzig het factuuradres van een order of factuur o.b.v. de meegestuurde gegevens.
     *
     * @param array{
     *     OrderId?: integer|null,
     *     InvoiceId?: integer|null,
     *     InvoiceAddress?: array{ProvinceId?: integer, ContactName?: string, CompanyName?: string, Address1?: string, PostalCode?: string, City?: string, CountryCode?: string}|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     *
     * @deprecated Let op! Versie 1.0 is verouderd. Gebruik versie v1.1. - Factuuradres wijzigen van een order of factuur
     */
    public function updateInvoiceAddressForOrderOrInvoice(
        array $parameters = [],
    ): Int32Logic4Response {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Orders/UpdateInvoiceAddressForOrderOrInvoice', ['json' => $parameters]),
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
    public function updateOrderStatus(
        array $parameters = [],
    ): BooleanLogic4Response {
        return BooleanLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Orders/UpdateOrderStatus', ['json' => $parameters]),
            )
        );
    }
}
