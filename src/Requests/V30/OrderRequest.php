<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V30;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V30\AssemblyAction;
use Webparking\Logic4Client\Responses\V30\InvoiceOpenPayment;
use Webparking\Logic4Client\Responses\V30\Order;
use Webparking\Logic4Client\Responses\V30\OrderAction;
use Webparking\Logic4Client\Responses\V30\OrderActionType;
use Webparking\Logic4Client\Responses\V30\OrderOpenPayment;
use Webparking\Logic4Client\Responses\V30\OrderRowV11;
use Webparking\Logic4Client\Responses\V30\OrderStatus;
use Webparking\Logic4Client\Responses\V30\ReturnCategory;
use Webparking\Logic4Client\Responses\V30\ReturnOrderV2;
use Webparking\Logic4Client\Responses\V30\ReturnProblemV11;
use Webparking\Logic4Client\Responses\V30\ReturnSolution;

class OrderRequest extends Request
{
    /**
     * Regels die de gegeven serienummer al hebben worden niet geweizigd.
     * <br />
     * Vanaf versie 3 wordt een aanroep afgewezen als er een orderregel in zit dat niet bestaat.
     * <br />
     * Geeft de hoeveelheid geupdate regels, exclusief regels die al het gegeven serienummer hadden.
     *
     * @param array{
     *     SerialNumberTypeId?: int,
     *     OrderRowSerialNumbers?: array<array{SerialNumber?: string|null, OrderRowId?: int}>,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addOrderRowSerialNumbers(array $parameters = []): int
    {
        return $this->buildResponse(
            $this->getClient()->post('/v3/Orders/AddOrderRowSerialNumbers', ['json' => $parameters]),
        );
    }

    /**
     * Voeg een betaling toe aan een order of factuur.
     *
     * @param array{
     *     OrderId?: int|null,
     *     InvoiceId?: int|null,
     *     AmountIncl?: number,
     *     Description?: string|null,
     *     BookingId?: int,
     *     MatchingLedgerId?: int,
     *     DateTime?: string|null,
     *     LedgerCode?: int|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addPayment(array $parameters = []): void
    {
        $this->getClient()->post('/v3/Orders/AddPayment', ['json' => $parameters]);
    }

    /**
     * Wijzig of maak een nieuwe factuur aan, het is alleen mogelijk om stamgegevens van een factuur te updaten (status, NAW, betaal/verzendmethode).
     * Factuurregels kunnen slechts eenmalig bij het aanmaken van de factuur gevuld worden.
     * Bij het succesvol aanmaken/updaten wordt het (nieuwe) factuurnummer in de response gevuld.
     *
     * @param array{
     *     Totals?: array{ShippingCost?: number, ShippingCostIncl?: number|null},
     *     DebtorId?: int|null,
     *     CustomerThirdPartyExternalIdentifer?: array{DebtorId?: int|null, TypeId?: int|null, Value?: string|null},
     *     Id?: int|null,
     *     PaymentMethod?: array{Id?: int, Description?: string|null, MaxAmount?: number|null, SelectKey?: string|null},
     *     ShippingMethod?: array{Id?: int, Name?: string|null, ExportCode?: string|null},
     *     CheckForOrderCostAndPaymentRegulation?: bool,
     *     OrderStatus?: array{Id?: int, Value?: string|null},
     *     OrderRows?: array<array{OrderRowWithProductComposition?: array{AddProductCompositionByParentProductToOrder?: bool, UseSystemPricesForProductCompositionProducts?: bool}, InclPrice?: number|null, GrossInclPrice?: number|null, Id?: int|null, Description?: string|null, Description2?: string|null, ProductId?: int|null, Qty?: number, BuyPrice?: number|null, GrossPrice?: number|null, NettPrice?: number|null, QtyDeliverd?: number, QtyDeliverd_NotInvoiced?: number, ProductCode?: string|null, ProductBarcode1?: string|null, VATPercentage?: number|null, Notes?: string|null, DebtorId?: int, OrderId?: int|null, WarehouseId?: int|null, Commission?: string|null, DeliveryOptionId?: int|null, VatCodeId?: int|null, VatCodeIdOverrule?: int|null, FreeValue1?: string|null, FreeValue2?: string|null, FreeValue3?: string|null, FreeValue4?: string|null, FreeValue5?: string|null, ExpectedNextDelivery?: string|null, ExternalValue?: array{TypeId?: int, Value?: string|null}, AgreedDeliveryDate?: string|null, Type1Id?: int|null, Type2Id?: int|null, Type3Id?: int|null, Type4Id?: int|null, Type5Id?: int|null}>,
     *     AcceptTermsAndConditions?: bool,
     *     DeliveryAddress?: array{TelephoneNumber?: string|null, Email?: string|null, Street2?: string|null, HouseNumber2?: string|null, HouseNumberAddition2?: string|null, Id?: int|null, ProvinceId?: int|null, ContactName?: string|null, CompanyName?: string|null, PostalCode?: string|null, City?: string|null, CountryCode?: string|null, Street?: string|null, HouseNumber?: string|null, HouseNumberAddition?: string|null},
     *     InvoiceAddress?: array{Id?: int|null, ProvinceId?: int|null, ContactName?: string|null, CompanyName?: string|null, PostalCode?: string|null, City?: string|null, CountryCode?: string|null, Street?: string|null, HouseNumber?: string|null, HouseNumberAddition?: string|null},
     *     CreationDate?: string,
     *     Description?: string|null,
     *     Reference?: string|null,
     *     BranchId?: int|null,
     *     UserId?: int|null,
     *     WebsiteDomainId?: int|null,
     *     DeliveryOptionId?: int|null,
     *     DeliveryDate?: string|null,
     *     OrderShipmentFreeValues?: array{ShipperTypeId?: int, Freevalue1?: string|null, Freevalue2?: string|null, Freevalue3?: string|null, Freevalue4?: string|null, Freevalue5?: string|null},
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
     */
    public function addUpdateInvoice(array $parameters = []): int
    {
        return $this->buildResponse(
            $this->getClient()->post('/v3/Orders/AddUpdateInvoice', ['json' => $parameters]),
        );
    }

    /**
     * Wijzig of maak een nieuwe order aan, het is alleen mogelijk om stamgegevens van een order te updaten (status, NAW, betaal/verzendmethode).
     * Orderregels kunnen slechts eenmalig bij het aanmaken van de order gevuld worden.
     * Bij het succesvol aanmaken/updaten wordt het (nieuwe) ordernummer in de response gevuld.
     * Met v1.2 of hoger kan het Id van het afleveradres gebruikt worden om het afleveradres te bepalen.
     * Met v1.3 of hoger wordt emballage meegenomen met de order.
     *
     * @param array{
     *     Totals?: array{ShippingCost?: number, ShippingCostIncl?: number|null},
     *     DebtorId?: int|null,
     *     CustomerThirdPartyExternalIdentifer?: array{DebtorId?: int|null, TypeId?: int|null, Value?: string|null},
     *     Id?: int|null,
     *     PaymentMethod?: array{Id?: int, Description?: string|null, MaxAmount?: number|null, SelectKey?: string|null},
     *     ShippingMethod?: array{Id?: int, Name?: string|null, ExportCode?: string|null},
     *     CheckForOrderCostAndPaymentRegulation?: bool,
     *     OrderStatus?: array{Id?: int, Value?: string|null},
     *     OrderRows?: array<array{OrderRowWithProductComposition?: array{AddProductCompositionByParentProductToOrder?: bool, UseSystemPricesForProductCompositionProducts?: bool}, InclPrice?: number|null, GrossInclPrice?: number|null, Id?: int|null, Description?: string|null, Description2?: string|null, ProductId?: int|null, Qty?: number, BuyPrice?: number|null, GrossPrice?: number|null, NettPrice?: number|null, QtyDeliverd?: number, QtyDeliverd_NotInvoiced?: number, ProductCode?: string|null, ProductBarcode1?: string|null, VATPercentage?: number|null, Notes?: string|null, DebtorId?: int, OrderId?: int|null, WarehouseId?: int|null, Commission?: string|null, DeliveryOptionId?: int|null, VatCodeId?: int|null, VatCodeIdOverrule?: int|null, FreeValue1?: string|null, FreeValue2?: string|null, FreeValue3?: string|null, FreeValue4?: string|null, FreeValue5?: string|null, ExpectedNextDelivery?: string|null, ExternalValue?: array{TypeId?: int, Value?: string|null}, AgreedDeliveryDate?: string|null, Type1Id?: int|null, Type2Id?: int|null, Type3Id?: int|null, Type4Id?: int|null, Type5Id?: int|null}>,
     *     AcceptTermsAndConditions?: bool,
     *     DeliveryAddress?: array{TelephoneNumber?: string|null, Email?: string|null, Street2?: string|null, HouseNumber2?: string|null, HouseNumberAddition2?: string|null, Id?: int|null, ProvinceId?: int|null, ContactName?: string|null, CompanyName?: string|null, PostalCode?: string|null, City?: string|null, CountryCode?: string|null, Street?: string|null, HouseNumber?: string|null, HouseNumberAddition?: string|null},
     *     InvoiceAddress?: array{Id?: int|null, ProvinceId?: int|null, ContactName?: string|null, CompanyName?: string|null, PostalCode?: string|null, City?: string|null, CountryCode?: string|null, Street?: string|null, HouseNumber?: string|null, HouseNumberAddition?: string|null},
     *     CreationDate?: string,
     *     Description?: string|null,
     *     Reference?: string|null,
     *     BranchId?: int|null,
     *     UserId?: int|null,
     *     WebsiteDomainId?: int|null,
     *     DeliveryOptionId?: int|null,
     *     DeliveryDate?: string|null,
     *     OrderShipmentFreeValues?: array{ShipperTypeId?: int, Freevalue1?: string|null, Freevalue2?: string|null, Freevalue3?: string|null, Freevalue4?: string|null, Freevalue5?: string|null},
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
     */
    public function addUpdateOrder(array $parameters = []): int
    {
        return $this->buildResponse(
            $this->getClient()->post('/v3/Orders/AddUpdateOrder', ['json' => $parameters]),
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
     *     OrderRowWithProductComposition?: array{AddProductCompositionByParentProductToOrder?: bool, ForceAddProductComposition?: bool, UseSystemPricesForProductCompositionProducts?: bool},
     *     InclPrice?: number|null,
     *     GrossInclPrice?: number|null,
     *     Id?: int|null,
     *     Description?: string|null,
     *     Description2?: string|null,
     *     ProductId?: int|null,
     *     Qty?: number,
     *     BuyPrice?: number|null,
     *     GrossPrice?: number|null,
     *     NettPrice?: number|null,
     *     QtyDeliverd?: number,
     *     QtyDeliverd_NotInvoiced?: number,
     *     ProductCode?: string|null,
     *     ProductBarcode1?: string|null,
     *     VATPercentage?: number|null,
     *     Notes?: string|null,
     *     DebtorId?: int,
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
     *     ExternalValue?: array{TypeId?: int, Value?: string|null},
     *     AgreedDeliveryDate?: string|null,
     *     Type1Id?: int|null,
     *     Type2Id?: int|null,
     *     Type3Id?: int|null,
     *     Type4Id?: int|null,
     *     Type5Id?: int|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addUpdateOrderRow(array $parameters = []): int
    {
        return $this->buildResponse(
            $this->getClient()->post('/v3/Orders/AddUpdateOrderRow', ['json' => $parameters]),
        );
    }

    /**
     * Maak en verwerk een factuur o.b.v. te factureren regels op een order.
     * Geef als argument de Id van de order.
     *
     * @throws Logic4ApiException
     */
    public function createAndProcessInvoiceForOrder(int $value): int
    {
        return $this->buildResponse(
            $this->getClient()->post('/v3/Orders/CreateAndProcessInvoiceForOrder', ['json' => $value]),
        );
    }

    /**
     * Een nieuwe retouropdracht aanmaken, het is alleen mogelijk om een retouropdracht aan te maken voor een bestaande order.
     * Alle details van de retouropdracht (OriginalOrderId, ProblemId, SolutionId, ReceivedReturnOrderDate) moeten geldig zijn.
     * Specificeer een negatieve waarde voor Qty in elke orderregel. Bij het succesvol aanmaken bevat de response het nummer van de retourorder.
     *
     * @param array{
     *     Totals?: array{ShippingCost?: number, ShippingCostIncl?: number|null},
     *     OriginalOrderId?: int,
     *     OriginalOrderDate?: string,
     *     OriginalOrderZipCode?: string|null,
     *     ProblemId?: int,
     *     SolutionId?: int,
     *     ReceivedReturnOrderDate?: string|null,
     *     ApprovedReturnOrderDate?: string|null,
     *     DebtorId?: int|null,
     *     CustomerThirdPartyExternalIdentifer?: array{DebtorId?: int|null, TypeId?: int|null, Value?: string|null},
     *     Id?: int|null,
     *     PaymentMethod?: array{Id?: int, Description?: string|null, MaxAmount?: number|null, SelectKey?: string|null},
     *     ShippingMethod?: array{Id?: int, Name?: string|null, ExportCode?: string|null},
     *     CheckForOrderCostAndPaymentRegulation?: bool,
     *     OrderStatus?: array{Id?: int, Value?: string|null},
     *     OrderRows?: array<array{OrderRowWithProductComposition?: array{AddProductCompositionByParentProductToOrder?: bool, UseSystemPricesForProductCompositionProducts?: bool}, InclPrice?: number|null, GrossInclPrice?: number|null, Id?: int|null, Description?: string|null, Description2?: string|null, ProductId?: int|null, Qty?: number, BuyPrice?: number|null, GrossPrice?: number|null, NettPrice?: number|null, QtyDeliverd?: number, QtyDeliverd_NotInvoiced?: number, ProductCode?: string|null, ProductBarcode1?: string|null, VATPercentage?: number|null, Notes?: string|null, DebtorId?: int, OrderId?: int|null, WarehouseId?: int|null, Commission?: string|null, DeliveryOptionId?: int|null, VatCodeId?: int|null, VatCodeIdOverrule?: int|null, FreeValue1?: string|null, FreeValue2?: string|null, FreeValue3?: string|null, FreeValue4?: string|null, FreeValue5?: string|null, ExpectedNextDelivery?: string|null, ExternalValue?: array{TypeId?: int, Value?: string|null}, AgreedDeliveryDate?: string|null, Type1Id?: int|null, Type2Id?: int|null, Type3Id?: int|null, Type4Id?: int|null, Type5Id?: int|null}>,
     *     AcceptTermsAndConditions?: bool,
     *     DeliveryAddress?: array{TelephoneNumber?: string|null, Email?: string|null, Street2?: string|null, HouseNumber2?: string|null, HouseNumberAddition2?: string|null, Id?: int|null, ProvinceId?: int|null, ContactName?: string|null, CompanyName?: string|null, PostalCode?: string|null, City?: string|null, CountryCode?: string|null, Street?: string|null, HouseNumber?: string|null, HouseNumberAddition?: string|null},
     *     InvoiceAddress?: array{Id?: int|null, ProvinceId?: int|null, ContactName?: string|null, CompanyName?: string|null, PostalCode?: string|null, City?: string|null, CountryCode?: string|null, Street?: string|null, HouseNumber?: string|null, HouseNumberAddition?: string|null},
     *     CreationDate?: string,
     *     Description?: string|null,
     *     Reference?: string|null,
     *     BranchId?: int|null,
     *     UserId?: int|null,
     *     WebsiteDomainId?: int|null,
     *     DeliveryOptionId?: int|null,
     *     DeliveryDate?: string|null,
     *     OrderShipmentFreeValues?: array{ShipperTypeId?: int, Freevalue1?: string|null, Freevalue2?: string|null, Freevalue3?: string|null, Freevalue4?: string|null, Freevalue5?: string|null},
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
     */
    public function createReturnOrder(array $parameters = []): int
    {
        return $this->buildResponse(
            $this->getClient()->post('/v3/Orders/CreateReturnOrder', ['json' => $parameters]),
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
     *     SkipRecords?: int,
     *     TakeRecords?: int,
     * } $parameters
     *
     * @return array<array-key, AssemblyAction>
     *
     * @throws Logic4ApiException
     */
    public function getAssemblyActions(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => AssemblyAction::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Orders/GetAssemblyActions', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Verkrijg alle assemblage actietypes.
     *
     * @return array<array-key, OrderActionType>
     *
     * @throws Logic4ApiException
     */
    public function getAssemblyActionsTypes(): array
    {
        return array_map(
            static fn (array $data) => OrderActionType::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/Orders/GetAssemblyActionsTypes'),
            ),
        );
    }

    /**
     * Verkrijg factuurregels o.b.v. het meegestuurde filter.
     * <br />
     * Levert maximaal 10.000 regels.
     * <br />
     * Vanaf versie 3 is het veld TakeRecords verplicht.
     *
     * @param array{
     *     OrderId?: int|null,
     *     BrandName?: string|null,
     *     LoadNextDeliveryDate?: bool,
     *     ChangedAfter?: string|null,
     *     TakeRecords?: int|null,
     *     FromId?: int|null,
     * } $parameters
     *
     * @return array<array-key, OrderRowV11>
     *
     * @throws Logic4ApiException
     */
    public function getInvoiceRows(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => OrderRowV11::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Orders/GetInvoiceRows', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Verkrijg facturen o.b.v. het meegestuurde filter.
     *
     * @param array{
     *     SkipRecords?: int,
     *     TakeRecords?: int,
     *     ChangedAfter?: string|null,
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
     *     LoadPayments?: bool,
     *     StatusId?: int|null,
     *     Type1Id?: int|null,
     *     Type2Id?: int|null,
     *     Type3Id?: int|null,
     *     WebsiteDomainIds?: array<int>,
     * } $parameters
     *
     * @return array<array-key, Order>
     *
     * @throws Logic4ApiException
     */
    public function getInvoices(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => Order::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Orders/GetInvoices', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Verkrijg offerteregels o.b.v. het meegestuurde filter.
     * <br />
     * Levert maximaal 10.000 regels.
     * <br />
     * Gebruik van het veld TakeRecords is verplicht.
     *
     * @param array{
     *     OrderId?: int|null,
     *     BrandName?: string|null,
     *     LoadNextDeliveryDate?: bool,
     *     ChangedAfter?: string|null,
     *     TakeRecords?: int|null,
     *     FromId?: int|null,
     * } $parameters
     *
     * @return array<array-key, OrderRowV11>
     *
     * @throws Logic4ApiException
     */
    public function getOfferRows(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => OrderRowV11::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Orders/GetOfferRows', ['json' => $parameters]),
            ),
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
     * @return array<array-key, InvoiceOpenPayment>
     *
     * @throws Logic4ApiException
     */
    public function getOpenPaymentInvoices(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => InvoiceOpenPayment::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Orders/GetOpenPaymentInvoices', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Verkrijg het nog te betalen bedrag van nog niet uitgeleverde orders.<br />
     * Indien historypoints zijn aangegeven, moet timeframe een van de volgende waarden hebben: ['Day', 'Week', 'Month', 'Quarter', 'Year'].
     *
     * @param array{
     *     SkipRecords?: int,
     *     TakeRecords?: int,
     *     TimeFrame?: mixed,
     *     HistoryPoints?: int|null,
     *     OrderstatusIds?: array<int>,
     *     WebsiteDomainIds?: array<int>,
     *     NotLinkedToWebsiteDomain?: bool,
     *     EmployeeIds?: array<int>,
     *     BranchIds?: array<int>,
     * } $parameters
     *
     * @return array<array-key, OrderOpenPayment>
     *
     * @throws Logic4ApiException
     */
    public function getOpenPaymentOrders(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => OrderOpenPayment::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Orders/GetOpenPaymentOrders', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Verkrijg het nog te betalen bedrag van nog niet uitgeleverde orders in totalen.
     *
     * @param array{
     *     TimeFrame?: mixed,
     *     HistoryPoints?: int|null,
     *     OrderstatusIds?: array<int>,
     *     WebsiteDomainIds?: array<int>,
     *     NotLinkedToWebsiteDomain?: bool,
     *     EmployeeIds?: array<int>,
     *     BranchIds?: array<int>,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getOpenPaymentOrdersTotals(
        array $parameters = [],
    ): OrderOpenPayment {
        return OrderOpenPayment::make(
            $this->buildResponse(
                $this->getClient()->post('/v3/Orders/GetOpenPaymentOrdersTotals', ['json' => $parameters]),
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
     * @return array<array-key, OrderAction>
     *
     * @throws Logic4ApiException
     */
    public function getOrderActions(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => OrderAction::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Orders/GetOrderActions', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Verkrijg alle order actietypes.
     *
     * @return array<array-key, OrderActionType>
     *
     * @throws Logic4ApiException
     */
    public function getOrderActionsTypes(): array
    {
        return array_map(
            static fn (array $data) => OrderActionType::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/Orders/GetOrderActionsTypes'),
            ),
        );
    }

    /**
     * Verkrijg order Id's o.b.v. het meegestuurde filter.
     *
     * @param array{
     *     OnlyCompleteForDelivery?: bool|null,
     *     OnlyWithCompletePayment?: bool|null,
     *     OrderStatus?: int|null,
     *     Warehouses?: array<int>,
     *     MustHaveQtyToDeliverNowAboveZero?: bool|null,
     *     HasPickbon?: bool|null,
     *     OnlyGetOrderIdsToCreatePickbonNow?: bool,
     *     ChangedAfter?: string|null,
     * } $parameters
     *
     * @return array<array-key, int>
     *
     * @throws Logic4ApiException
     */
    public function getOrderIds(array $parameters = []): array
    {
        return $this->buildResponse(
            $this->getClient()->post('/v3/Orders/GetOrderIds', ['json' => $parameters]),
        );
    }

    /**
     * Verkrijg ordersregels o.b.v. het meegestuurde filter.
     * <br />
     * Levert maximaal 10.000 regels.
     * <br />
     * Vanaf versie 3 is het veld TakeRecords verplicht.
     *
     * @param array{
     *     OrderId?: int|null,
     *     BrandName?: string|null,
     *     LoadNextDeliveryDate?: bool,
     *     ChangedAfter?: string|null,
     *     TakeRecords?: int|null,
     *     FromId?: int|null,
     * } $parameters
     *
     * @return array<array-key, OrderRowV11>
     *
     * @throws Logic4ApiException
     */
    public function getOrderRows(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => OrderRowV11::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Orders/GetOrderRows', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Verkrijg orders o.b.v. het meegestuurde filter.
     *
     * @param array{
     *     SkipRecords?: int,
     *     TakeRecords?: int,
     *     ChangedAfter?: string|null,
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
     *     LoadPayments?: bool,
     *     StatusId?: int|null,
     *     Type1Id?: int|null,
     *     Type2Id?: int|null,
     *     Type3Id?: int|null,
     *     WebsiteDomainIds?: array<int>,
     * } $parameters
     *
     * @return array<array-key, Order>
     *
     * @throws Logic4ApiException
     */
    public function getOrders(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => Order::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Orders/GetOrders', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Haal alle orderstatussen op.
     *
     * @return array<array-key, OrderStatus>
     *
     * @throws Logic4ApiException
     */
    public function getOrderStatuses(): array
    {
        return array_map(
            static fn (array $data) => OrderStatus::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/Orders/GetOrderStatuses'),
            ),
        );
    }

    /**
     * Verkrijg alle order retourcategorieën.
     *
     * @return array<array-key, ReturnCategory>
     *
     * @throws Logic4ApiException
     */
    public function getReturnCategories(): array
    {
        return array_map(
            static fn (array $data) => ReturnCategory::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/Orders/GetReturnCategories'),
            ),
        );
    }

    /**
     * Verkrijg retourorders o.b.v. het meegestuurde filter.
     *
     * @param array{
     *     ReceivedReturnOrderDateFrom?: string|null,
     *     ReceivedReturnOrderDateTo?: string|null,
     *     SkipRecords?: int,
     *     TakeRecords?: int,
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
     *     LoadPayments?: bool,
     *     StatusId?: int|null,
     *     Type1Id?: int|null,
     *     Type2Id?: int|null,
     *     Type3Id?: int|null,
     *     WebsiteDomainIds?: array<int>,
     * } $parameters
     *
     * @return array<array-key, ReturnOrderV2>
     *
     * @throws Logic4ApiException
     */
    public function getReturnOrders(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => ReturnOrderV2::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Orders/GetReturnOrders', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Verkrijg retourproblemen o.b.v. het filter.
     *
     * @param array{
     *     SkipRecords?: int,
     *     TakeRecords?: int,
     * } $parameters
     *
     * @return array<array-key, ReturnProblemV11>
     *
     * @throws Logic4ApiException
     */
    public function getReturnProblems(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => ReturnProblemV11::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Orders/GetReturnProblems', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Verkrijg order retouroplossingen o.b.v. het filter.
     *
     * @param array{
     *     SkipRecords?: int,
     *     TakeRecords?: int,
     * } $parameters
     *
     * @return array<array-key, ReturnSolution>
     *
     * @throws Logic4ApiException
     */
    public function getReturnSolutions(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => ReturnSolution::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Orders/GetReturnSolutions', ['json' => $parameters]),
            ),
        );
    }

    /**
     * @return array<array-key, Order>
     *
     * @throws Logic4ApiException
     */
    public function getSerialnumberTypes(): array
    {
        return array_map(
            static fn (array $data) => Order::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/Orders/GetSerialnumberTypes'),
            ),
        );
    }

    /**
     * Maakt een factuur aan, werkt voorraadmutaties bij, maakt financiële boekingen voor kosten en omzet aan,
     * zet het bedrag van de order naar de de factuur en zet de factuur op gesloten.
     * Geef als argument de Id van de factuur.
     *
     * @return array<array-key, int>
     *
     * @throws Logic4ApiException
     */
    public function processInvoice(int $value): array
    {
        return $this->buildResponse(
            $this->getClient()->post('/v3/Orders/ProcessInvoice', ['json' => $value]),
        );
    }

    /**
     * Email wordt standaard niet verstuurd als de debiteur of de betaalmethode facturen via email uit heeft staan.
     * <br />
     * Geeft het ID van de verzonden email, of 0 als er geen email is verzonden.
     * <br />
     * Voor deze aanroep zijn extra rechten vereist.
     *
     * @param array{
     *     InvoiceId?: int,
     *     IgnoreDebtorElectronicInvoicePreference?: bool,
     *     IgnorePaymentTypeElectronicInvoicePreference?: bool,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function sendEmailForInvoice(array $parameters = []): int
    {
        return $this->buildResponse(
            $this->getClient()->post('/v3/Orders/SendEmailForInvoice', ['json' => $parameters]),
        );
    }

    /**
     * Voorzie orderregels met een afgesproken afleverdatum.
     *
     * @param array<array{
     *     RowId?: int,
     *     AgreedDeliveryDate?: string|null,
     * }> $parameters
     *
     * @throws Logic4ApiException
     */
    public function updateAgreedDeliveryDatesForOrderRows(array $parameters = []): void
    {
        $this->getClient()->post('/v3/Orders/UpdateAgreedDeliveryDatesForOrderRows', ['json' => $parameters]);
    }

    /**
     * Wijzig het contactadres van een order of factuur o.b.v. de meegestuurde gegevens.
     *
     * @param array{
     *     OrderId?: int|null,
     *     InvoiceId?: int|null,
     *     ContactAddress?: array{Id?: int|null, ProvinceId?: int|null, ContactName?: string|null, CompanyName?: string|null, PostalCode?: string|null, City?: string|null, CountryCode?: string|null, Street?: string|null, HouseNumber?: string|null, HouseNumberAddition?: string|null},
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function updateContactAddressForOrderOrInvoice(array $parameters = []): int
    {
        return $this->buildResponse(
            $this->getClient()->post('/v3/Orders/UpdateContactAddressForOrderOrInvoice', ['json' => $parameters]),
        );
    }

    /**
     * Wijzig het afleveradres van een order of factuur o.b.v. de meegestuurde gegevens.
     *
     * @param array{
     *     OrderId?: int|null,
     *     InvoiceId?: int|null,
     *     DeliveryAddress?: array{TelephoneNumber?: string|null, Email?: string|null, Street2?: string|null, HouseNumber2?: string|null, HouseNumberAddition2?: string|null, Id?: int|null, ProvinceId?: int|null, ContactName?: string|null, CompanyName?: string|null, PostalCode?: string|null, City?: string|null, CountryCode?: string|null, Street?: string|null, HouseNumber?: string|null, HouseNumberAddition?: string|null},
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function updateDeliveryAddressForOrderOrInvoice(array $parameters = []): int
    {
        return $this->buildResponse(
            $this->getClient()->post('/v3/Orders/UpdateDeliveryAddressForOrderOrInvoice', ['json' => $parameters]),
        );
    }

    /**
     * Wijzig het factuuradres van een order of factuur o.b.v. de meegestuurde gegevens.
     *
     * @param array{
     *     OrderId?: int|null,
     *     InvoiceId?: int|null,
     *     InvoiceAddress?: array{Id?: int|null, ProvinceId?: int|null, ContactName?: string|null, CompanyName?: string|null, PostalCode?: string|null, City?: string|null, CountryCode?: string|null, Street?: string|null, HouseNumber?: string|null, HouseNumberAddition?: string|null},
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function updateInvoiceAddressForOrderOrInvoice(array $parameters = []): int
    {
        return $this->buildResponse(
            $this->getClient()->post('/v3/Orders/UpdateInvoiceAddressForOrderOrInvoice', ['json' => $parameters]),
        );
    }

    /**
     * Update de status van een order.
     *
     * @param array{
     *     StatusId?: int,
     *     OrderId?: int,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function updateOrderStatus(array $parameters = []): void
    {
        $this->getClient()->post('/v3/Orders/UpdateOrderStatus', ['json' => $parameters]);
    }
}
