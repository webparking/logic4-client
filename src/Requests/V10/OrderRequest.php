<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V10;

use Webparking\Logic4Client\Data\V10\AssemblyAction;
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
     *     SerialNumberTypeId?: int|null,
     *     OrderRowSerialNumbers?: array<array{SerialNumber?: string|null, OrderRowId?: int}>|null,
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
     *     OrderId?: int|null,
     *     InvoiceId?: int|null,
     *     AmountIncl?: number|null,
     *     Description?: string|null,
     *     BookingId?: int|null,
     *     MatchingLedgerId?: int|null,
     *     DateTime?: string|null,
     *     LedgerCode?: int|null,
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
     *     CheckForOrderCostAndPaymentRegulation?: bool|null,
     *     DebtorId?: int|null,
     *     CustomerThirdPartyExternalIdentifer?: array{DebtorId?: int|null, TypeId?: int|null, Value?: string|null}|null,
     *     Id?: int|null,
     *     PaymentMethod?: array{Id?: int, Description?: string|null, MaxAmount?: number|null, SelectKey?: string|null}|null,
     *     ShippingMethod?: array{Id?: int, Name?: string|null, ExportCode?: string|null}|null,
     *     Totals?: array{AmountEx?: number, VATPercentage?: number, Calc_TotalPayed?: number|null, AmountIncl?: number, IsPaid?: bool, ShippingCost?: number, ShippingCostIncl?: number|null}|null,
     *     OrderStatus?: array{Id?: int, Value?: string|null}|null,
     *     OrderRows?: array<array{OrderRowWithProductComposition?: array{AddProductCompositionByParentProductToOrder?: bool, UseSystemPricesForProductCompositionProducts?: bool}, InclPrice?: number|null, GrossInclPrice?: number|null, Id?: int|null, Description?: string|null, Description2?: string|null, ProductId?: int|null, Qty?: number, BuyPrice?: number|null, GrossPrice?: number|null, NettPrice?: number|null, QtyDeliverd?: number, QtyDeliverd_NotInvoiced?: number, ProductCode?: string|null, ProductBarcode1?: string|null, VATPercentage?: number|null, Notes?: string|null, DebtorId?: int, OrderId?: int|null, WarehouseId?: int|null, Commission?: string|null, DeliveryOptionId?: int|null, VatCodeId?: int|null, VatCodeIdOverrule?: int|null, FreeValue1?: string|null, FreeValue2?: string|null, FreeValue3?: string|null, FreeValue4?: string|null, FreeValue5?: string|null, ExpectedNextDelivery?: string|null, ExternalValue?: array{TypeId?: int, Value?: string|null}, AgreedDeliveryDate?: string|null, Type1Id?: int|null, Type2Id?: int|null, Type3Id?: int|null, Type4Id?: int|null, Type5Id?: int|null}>|null,
     *     AcceptTermsAndConditions?: bool|null,
     *     DeliveryAddress?: array{Type?: array{Id?: int, Name?: string|null}, Province?: array{Id?: int, Name?: string|null}, Email?: string|null, ContactName?: string|null, CompanyName?: string|null, Address1?: string|null, Address2?: string|null, Id?: int|null, DebtorId?: int|null, CreditorId?: int|null, IsMainContact?: bool, IsHidden?: bool|null, OwnContactNumber?: string|null, CountryCode?: string|null, IsoCode?: string|null, City?: string|null, Zipcode?: string|null, Street?: string|null, HouseNumber?: string|null, HouseNumberAddition?: string|null, TelephoneNumber?: string|null, CountryId?: int, ZoneId?: int}|null,
     *     InvoiceAddress?: array{Type?: array{Id?: int, Name?: string|null}, Province?: array{Id?: int, Name?: string|null}, Email?: string|null, ContactName?: string|null, CompanyName?: string|null, Address1?: string|null, Address2?: string|null, Id?: int|null, DebtorId?: int|null, CreditorId?: int|null, IsMainContact?: bool, IsHidden?: bool|null, OwnContactNumber?: string|null, CountryCode?: string|null, IsoCode?: string|null, City?: string|null, Zipcode?: string|null, Street?: string|null, HouseNumber?: string|null, HouseNumberAddition?: string|null, TelephoneNumber?: string|null, CountryId?: int, ZoneId?: int}|null,
     *     CreationDate?: string|null,
     *     Description?: string|null,
     *     Reference?: string|null,
     *     BranchId?: int|null,
     *     UserId?: int|null,
     *     WebsiteDomainId?: int|null,
     *     DeliveryOptionId?: int|null,
     *     DeliveryDate?: string|null,
     *     OrderShipmentFreeValues?: array{ShipperTypeId?: int, Freevalue1?: string|null, Freevalue2?: string|null, Freevalue3?: string|null, Freevalue4?: string|null, Freevalue5?: string|null}|null,
     *     Notes?: string|null,
     *     FreeValue1?: string|null,
     *     FreeValue2?: string|null,
     *     FreeValue3?: string|null,
     *     FreeValue4?: string|null,
     *     FreeValue5?: string|null,
     *     FreeValue6?: string|null,
     *     FreeValue7?: string|null,
     *     FreeValue8?: string|null,
     *     OrderType1Id?: int|null,
     *     OrderType2Id?: int|null,
     *     OrderType3Id?: int|null,
     *     OrderType4Id?: int|null,
     *     OrderType5Id?: int|null,
     *     OrderType6Id?: int|null,
     *     OrderType7Id?: int|null,
     *     OrderType8Id?: int|null,
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
     *     CheckForOrderCostAndPaymentRegulation?: bool|null,
     *     DebtorId?: int|null,
     *     CustomerThirdPartyExternalIdentifer?: array{DebtorId?: int|null, TypeId?: int|null, Value?: string|null}|null,
     *     Id?: int|null,
     *     PaymentMethod?: array{Id?: int, Description?: string|null, MaxAmount?: number|null, SelectKey?: string|null}|null,
     *     ShippingMethod?: array{Id?: int, Name?: string|null, ExportCode?: string|null}|null,
     *     Totals?: array{AmountEx?: number, VATPercentage?: number, Calc_TotalPayed?: number|null, AmountIncl?: number, IsPaid?: bool, ShippingCost?: number, ShippingCostIncl?: number|null}|null,
     *     OrderStatus?: array{Id?: int, Value?: string|null}|null,
     *     OrderRows?: array<array{OrderRowWithProductComposition?: array{AddProductCompositionByParentProductToOrder?: bool, UseSystemPricesForProductCompositionProducts?: bool}, InclPrice?: number|null, GrossInclPrice?: number|null, Id?: int|null, Description?: string|null, Description2?: string|null, ProductId?: int|null, Qty?: number, BuyPrice?: number|null, GrossPrice?: number|null, NettPrice?: number|null, QtyDeliverd?: number, QtyDeliverd_NotInvoiced?: number, ProductCode?: string|null, ProductBarcode1?: string|null, VATPercentage?: number|null, Notes?: string|null, DebtorId?: int, OrderId?: int|null, WarehouseId?: int|null, Commission?: string|null, DeliveryOptionId?: int|null, VatCodeId?: int|null, VatCodeIdOverrule?: int|null, FreeValue1?: string|null, FreeValue2?: string|null, FreeValue3?: string|null, FreeValue4?: string|null, FreeValue5?: string|null, ExpectedNextDelivery?: string|null, ExternalValue?: array{TypeId?: int, Value?: string|null}, AgreedDeliveryDate?: string|null, Type1Id?: int|null, Type2Id?: int|null, Type3Id?: int|null, Type4Id?: int|null, Type5Id?: int|null}>|null,
     *     AcceptTermsAndConditions?: bool|null,
     *     DeliveryAddress?: array{Type?: array{Id?: int, Name?: string|null}, Province?: array{Id?: int, Name?: string|null}, Email?: string|null, ContactName?: string|null, CompanyName?: string|null, Address1?: string|null, Address2?: string|null, Id?: int|null, DebtorId?: int|null, CreditorId?: int|null, IsMainContact?: bool, IsHidden?: bool|null, OwnContactNumber?: string|null, CountryCode?: string|null, IsoCode?: string|null, City?: string|null, Zipcode?: string|null, Street?: string|null, HouseNumber?: string|null, HouseNumberAddition?: string|null, TelephoneNumber?: string|null, CountryId?: int, ZoneId?: int}|null,
     *     InvoiceAddress?: array{Type?: array{Id?: int, Name?: string|null}, Province?: array{Id?: int, Name?: string|null}, Email?: string|null, ContactName?: string|null, CompanyName?: string|null, Address1?: string|null, Address2?: string|null, Id?: int|null, DebtorId?: int|null, CreditorId?: int|null, IsMainContact?: bool, IsHidden?: bool|null, OwnContactNumber?: string|null, CountryCode?: string|null, IsoCode?: string|null, City?: string|null, Zipcode?: string|null, Street?: string|null, HouseNumber?: string|null, HouseNumberAddition?: string|null, TelephoneNumber?: string|null, CountryId?: int, ZoneId?: int}|null,
     *     CreationDate?: string|null,
     *     Description?: string|null,
     *     Reference?: string|null,
     *     BranchId?: int|null,
     *     UserId?: int|null,
     *     WebsiteDomainId?: int|null,
     *     DeliveryOptionId?: int|null,
     *     DeliveryDate?: string|null,
     *     OrderShipmentFreeValues?: array{ShipperTypeId?: int, Freevalue1?: string|null, Freevalue2?: string|null, Freevalue3?: string|null, Freevalue4?: string|null, Freevalue5?: string|null}|null,
     *     Notes?: string|null,
     *     FreeValue1?: string|null,
     *     FreeValue2?: string|null,
     *     FreeValue3?: string|null,
     *     FreeValue4?: string|null,
     *     FreeValue5?: string|null,
     *     FreeValue6?: string|null,
     *     FreeValue7?: string|null,
     *     FreeValue8?: string|null,
     *     OrderType1Id?: int|null,
     *     OrderType2Id?: int|null,
     *     OrderType3Id?: int|null,
     *     OrderType4Id?: int|null,
     *     OrderType5Id?: int|null,
     *     OrderType6Id?: int|null,
     *     OrderType7Id?: int|null,
     *     OrderType8Id?: int|null,
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
     *     OrderRowWithProductComposition?: array{AddProductCompositionByParentProductToOrder?: bool, UseSystemPricesForProductCompositionProducts?: bool}|null,
     *     InclPrice?: number|null,
     *     GrossInclPrice?: number|null,
     *     Id?: int|null,
     *     Description?: string|null,
     *     Description2?: string|null,
     *     ProductId?: int|null,
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
     *     DebtorId?: int|null,
     *     OrderId?: int|null,
     *     WarehouseId?: int|null,
     *     Commission?: string|null,
     *     DeliveryOptionId?: int|null,
     *     VatCodeId?: int|null,
     *     VatCodeIdOverrule?: int|null,
     *     FreeValue1?: string|null,
     *     FreeValue2?: string|null,
     *     FreeValue3?: string|null,
     *     FreeValue4?: string|null,
     *     FreeValue5?: string|null,
     *     ExpectedNextDelivery?: string|null,
     *     ExternalValue?: array{TypeId?: int, Value?: string|null}|null,
     *     AgreedDeliveryDate?: string|null,
     *     Type1Id?: int|null,
     *     Type2Id?: int|null,
     *     Type3Id?: int|null,
     *     Type4Id?: int|null,
     *     Type5Id?: int|null,
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
     *     Totals?: array{AmountEx?: number, VATPercentage?: number, Calc_TotalPayed?: number|null, AmountIncl?: number, IsPaid?: bool, ShippingCost?: number, ShippingCostIncl?: number|null}|null,
     *     OriginalOrderId?: int|null,
     *     OriginalOrderDate?: string|null,
     *     OriginalOrderZipCode?: string|null,
     *     ProblemId?: int|null,
     *     SolutionId?: int|null,
     *     ReceivedReturnOrderDate?: string|null,
     *     ApprovedReturnOrderDate?: string|null,
     *     DebtorId?: int|null,
     *     CustomerThirdPartyExternalIdentifer?: array{DebtorId?: int|null, TypeId?: int|null, Value?: string|null}|null,
     *     Id?: int|null,
     *     PaymentMethod?: array{Id?: int, Description?: string|null, MaxAmount?: number|null, SelectKey?: string|null}|null,
     *     ShippingMethod?: array{Id?: int, Name?: string|null, ExportCode?: string|null}|null,
     *     CheckForOrderCostAndPaymentRegulation?: bool|null,
     *     OrderStatus?: array{Id?: int, Value?: string|null}|null,
     *     OrderRows?: array<array{OrderRowWithProductComposition?: array{AddProductCompositionByParentProductToOrder?: bool, UseSystemPricesForProductCompositionProducts?: bool}, InclPrice?: number|null, GrossInclPrice?: number|null, Id?: int|null, Description?: string|null, Description2?: string|null, ProductId?: int|null, Qty?: number, BuyPrice?: number|null, GrossPrice?: number|null, NettPrice?: number|null, QtyDeliverd?: number, QtyDeliverd_NotInvoiced?: number, ProductCode?: string|null, ProductBarcode1?: string|null, VATPercentage?: number|null, Notes?: string|null, DebtorId?: int, OrderId?: int|null, WarehouseId?: int|null, Commission?: string|null, DeliveryOptionId?: int|null, VatCodeId?: int|null, VatCodeIdOverrule?: int|null, FreeValue1?: string|null, FreeValue2?: string|null, FreeValue3?: string|null, FreeValue4?: string|null, FreeValue5?: string|null, ExpectedNextDelivery?: string|null, ExternalValue?: array{TypeId?: int, Value?: string|null}, AgreedDeliveryDate?: string|null, Type1Id?: int|null, Type2Id?: int|null, Type3Id?: int|null, Type4Id?: int|null, Type5Id?: int|null}>|null,
     *     AcceptTermsAndConditions?: bool|null,
     *     DeliveryAddress?: array{TelephoneNumber?: string|null, Email?: string|null, Street2?: string|null, HouseNumber2?: string|null, HouseNumberAddition2?: string|null, Id?: int|null, ProvinceId?: int|null, ContactName?: string|null, CompanyName?: string|null, PostalCode?: string|null, City?: string|null, CountryCode?: string|null, Street?: string|null, HouseNumber?: string|null, HouseNumberAddition?: string|null}|null,
     *     InvoiceAddress?: array{Id?: int|null, ProvinceId?: int|null, ContactName?: string|null, CompanyName?: string|null, PostalCode?: string|null, City?: string|null, CountryCode?: string|null, Street?: string|null, HouseNumber?: string|null, HouseNumberAddition?: string|null}|null,
     *     CreationDate?: string|null,
     *     Description?: string|null,
     *     Reference?: string|null,
     *     BranchId?: int|null,
     *     UserId?: int|null,
     *     WebsiteDomainId?: int|null,
     *     DeliveryOptionId?: int|null,
     *     DeliveryDate?: string|null,
     *     OrderShipmentFreeValues?: array{ShipperTypeId?: int, Freevalue1?: string|null, Freevalue2?: string|null, Freevalue3?: string|null, Freevalue4?: string|null, Freevalue5?: string|null}|null,
     *     Notes?: string|null,
     *     FreeValue1?: string|null,
     *     FreeValue2?: string|null,
     *     FreeValue3?: string|null,
     *     FreeValue4?: string|null,
     *     FreeValue5?: string|null,
     *     FreeValue6?: string|null,
     *     FreeValue7?: string|null,
     *     FreeValue8?: string|null,
     *     OrderType1Id?: int|null,
     *     OrderType2Id?: int|null,
     *     OrderType3Id?: int|null,
     *     OrderType4Id?: int|null,
     *     OrderType5Id?: int|null,
     *     OrderType6Id?: int|null,
     *     OrderType7Id?: int|null,
     *     OrderType8Id?: int|null,
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
     * Verkrijg acties die hebben plaatsgevonden i.m.v. het assembleren van artikelen.
     *
     * @param array{
     *     StartDateTime?: string|null,
     *     EndDateTime?: string|null,
     *     OrderId?: int|null,
     *     TypeId?: int|null,
     *     UserId?: int|null,
     *     Description?: string|null,
     *     SkipRecords?: int|null,
     *     TakeRecords?: int|null,
     * } $parameters
     *
     * @return \Generator<array-key, AssemblyAction>
     *
     * @throws Logic4ApiException
     */
    public function getAssemblyActions(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1/Orders/GetAssemblyActions', $parameters);

        foreach ($iterator as $record) {
            yield AssemblyAction::make($record);
        }
    }

    /**
     * Verkrijg alle assemblage actietypes.
     *
     * @throws Logic4ApiException
     */
    public function getAssemblyActionsTypes(): OrderActionTypeLogic4ResponseList
    {
        return OrderActionTypeLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Orders/GetAssemblyActionsTypes'),
            )
        );
    }

    /**
     * Verkrijg factuurregels o.b.v. het meegestuurde filter.
     *
     * @param array{
     *     OrderId?: int|null,
     *     BrandName?: string|null,
     *     LoadNextDeliveryDate?: bool|null,
     *     ChangedAfter?: string|null,
     *     TakeRecords?: int|null,
     *     FromId?: int|null,
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
     *     DebtorId?: int|null,
     *     DateFrom?: string|null,
     *     DateTo?: string|null,
     *     DaysPastDueDate?: int|null,
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
     *     HistoryPoints?: int|null,
     *     OrderstatusIds?: array<int>|null,
     *     WebsiteDomainIds?: array<int>|null,
     *     NotLinkedToWebsiteDomain?: bool|null,
     *     EmployeeIds?: array<int>|null,
     *     BranchIds?: array<int>|null,
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
     *     HistoryPoints?: int|null,
     *     OrderstatusIds?: array<int>|null,
     *     WebsiteDomainIds?: array<int>|null,
     *     NotLinkedToWebsiteDomain?: bool|null,
     *     EmployeeIds?: array<int>|null,
     *     BranchIds?: array<int>|null,
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
     *     OrderId?: int|null,
     *     TypeId?: int|null,
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
     *     OnlyCompleteForDelivery?: bool|null,
     *     OnlyWithCompletePayment?: bool|null,
     *     OrderStatus?: int|null,
     *     Warehouses?: array<int>|null,
     *     MustHaveQtyToDeliverNowAboveZero?: bool|null,
     *     HasPickbon?: bool|null,
     *     OnlyGetOrderIdsToCreatePickbonNow?: bool|null,
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
     *     OrderId?: int|null,
     *     BrandName?: string|null,
     *     LoadNextDeliveryDate?: bool|null,
     *     ChangedAfter?: string|null,
     *     TakeRecords?: int|null,
     *     FromId?: int|null,
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
     * @throws Logic4ApiException
     *
     * @deprecated Let op! Versie 1.0 is verouderd. Gebruik versie v1.3. - Orders ophalen
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
     * Email wordt standaard niet verstuurd als de debuteur of de betaalmethode facturen via email uit heeft staan.
     *
     * @param array{
     *     InvoiceId?: int|null,
     *     IgnoreDebtorElectronicInvoicePreference?: bool|null,
     *     IgnorePaymentTypeElectronicInvoicePreference?: bool|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function sendEmailForInvoice(
        array $parameters = [],
    ): Int32Logic4Response {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Orders/SendEmailForInvoice', ['json' => $parameters]),
            )
        );
    }

    /**
     * Voorzie orderregels met een afgesproken afleverdatum.
     *
     * @param array<array{
     *     RowId?: int|null,
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
     *     OrderId?: int|null,
     *     InvoiceId?: int|null,
     *     ContactAddress?: array{ProvinceId?: int|null, ContactName?: string|null, CompanyName?: string|null, Address1?: string|null, PostalCode?: string|null, City?: string|null, CountryCode?: string|null}|null,
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
     *     OrderId?: int|null,
     *     InvoiceId?: int|null,
     *     DeliveryAddress?: array{Address2?: string|null, TelephoneNumber?: string|null, Email?: string|null, ProvinceId?: int|null, ContactName?: string|null, CompanyName?: string|null, Address1?: string|null, PostalCode?: string|null, City?: string|null, CountryCode?: string|null}|null,
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
     *     OrderId?: int|null,
     *     InvoiceId?: int|null,
     *     InvoiceAddress?: array{ProvinceId?: int|null, ContactName?: string|null, CompanyName?: string|null, Address1?: string|null, PostalCode?: string|null, City?: string|null, CountryCode?: string|null}|null,
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
     *     StatusId?: int|null,
     *     OrderId?: int|null,
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
