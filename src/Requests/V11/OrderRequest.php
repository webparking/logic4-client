<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V11;

use Webparking\Logic4Client\Data\V11\OrderOpenPayment;
use Webparking\Logic4Client\Data\V11\ReturnProblemV11;
use Webparking\Logic4Client\Data\V11\ReturnSolution;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V11\Int32Logic4Response;
use Webparking\Logic4Client\Responses\V11\OrderLogic4ResponseList;

class OrderRequest extends Request
{
    /**
     * Wijzig of maak een nieuwe factuur aan, het is alleen mogelijk om stamgegevens van een factuur te updaten (status, NAW, betaal/verzendmethode).
     * Factuurregels kunnen slechts eenmalig bij het aanmaken van de factuur gevuld worden.
     * Bij het succesvol aanmaken/updaten wordt het (nieuwe) factuurnummer in de response gevuld.
     *
     * @param array{
     *     Totals?: array{AmountEx?: number, VATPercentage?: number, Calc_TotalPayed?: number|null, AmountIncl?: number, IsPaid?: bool, ShippingCost?: number, ShippingCostIncl?: number|null}|null,
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
     * @deprecated Let op! Versie 1.1 is verouderd. Gebruik versie v1.3. - Factuur toevoegen of updaten
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
     *
     * @param array{
     *     Totals?: array{AmountEx?: number, VATPercentage?: number, Calc_TotalPayed?: number|null, AmountIncl?: number, IsPaid?: bool, ShippingCost?: number, ShippingCostIncl?: number|null}|null,
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
     * @deprecated Let op! Versie 1.1 is verouderd. Gebruik versie v1.3. - Order toevoegen of updaten
     */
    public function addUpdateOrder(array $parameters = []): Int32Logic4Response
    {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.1/Orders/AddUpdateOrder', ['json' => $parameters]),
            )
        );
    }

    /**
     * Voeg een nieuwe orderregel toe of update een bestaande. Om een bestaande te updaten dient het veld 'Id' gevuld te zijn met een bestaand orderregelnummer.
     *
     * De optie "OrderRowWithProductComposition": {"AddProductCompositionByParentProductToOrder": true} heeft het volgende gedrag.
     * - Bij een nieuw product worden samenstellingen toegevoegd als het product een samengesteld product is.
     * - Bij een bestaand product worden samenstellingen toegevoegd mits er nog geen samenstellingen aanwezig zijn, anders komt er een foutmelding terug.
     *
     * De optie "ForceAddProductComposition" zorgt ervoor dat samenstellingen <strong>altijd</strong> worden toegevoegd, ongeacht of er reeds samenstellingen bestaan voor deze orderregel.
     *
     * @param array{
     *     OrderRowWithProductComposition?: array{AddProductCompositionByParentProductToOrder?: bool, ForceAddProductComposition?: bool, UseSystemPricesForProductCompositionProducts?: bool}|null,
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
     * Een nieuwe retouropdracht aanmaken, het is alleen mogelijk om een retouropdracht aan te maken voor een bestaande order.
     * Alle details van de retouropdracht (OriginalOrderId, ProblemId, SolutionId, ReceivedReturnOrderDate) moeten geldig zijn.
     * Specificeer een negatieve waarde voor Qty in elke orderregel. Bij het succesvol aanmaken bevat de response het nummer van de retourorder.
     *
     * @param array{
     *     Totals?: array{ShippingCost?: number, ShippingCostIncl?: number|null}|null,
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
     */
    public function createReturnOrder(array $parameters = []): Int32Logic4Response
    {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.1/Orders/CreateReturnOrder', ['json' => $parameters]),
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
     * @deprecated Let op! Versie 1.1 is verouderd. Gebruik versie v1.2. - Facturen ophalen
     */
    public function getInvoices(array $parameters = []): OrderLogic4ResponseList
    {
        return OrderLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.1/Orders/GetInvoices', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg het nog te betalen bedrag van nog niet uitgeleverde orders.
     *
     * Indien historypoints zijn aangegeven, moet timeframe een van de volgende waarden hebben: ['Day', 'Week', 'Month', 'Quarter', 'Year'].
     *
     * @param array{
     *     SkipRecords?: int|null,
     *     TakeRecords?: int|null,
     *     TimeFrame?: string|null,
     *     HistoryPoints?: int|null,
     *     OrderstatusIds?: array<int>|null,
     *     WebsiteDomainIds?: array<int>|null,
     *     NotLinkedToWebsiteDomain?: bool|null,
     *     EmployeeIds?: array<int>|null,
     *     BranchIds?: array<int>|null,
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
     * @deprecated Let op! Versie 1.1 is verouderd. Gebruik versie v1.3. - Orders ophalen
     */
    public function getOrders(array $parameters = []): OrderLogic4ResponseList
    {
        return OrderLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.1/Orders/GetOrders', ['json' => $parameters]),
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
     * @deprecated Let op! Versie 1.1 is verouderd. Gebruik versie v2.0. - Retourorders ophalen
     */
    public function getReturnOrders(
        array $parameters = [],
    ): OrderLogic4ResponseList {
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
     *     SkipRecords?: int|null,
     *     TakeRecords?: int|null,
     * } $parameters
     *
     * @return \Generator<array-key, ReturnProblemV11>
     *
     * @throws Logic4ApiException
     */
    public function getReturnProblems(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1.1/Orders/GetReturnProblems', $parameters);

        foreach ($iterator as $record) {
            yield ReturnProblemV11::make($record);
        }
    }

    /**
     * Verkrijg order retouroplossingen o.b.v. het filter.
     *
     * @param array{
     *     SkipRecords?: int|null,
     *     TakeRecords?: int|null,
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
     * Wijzig het contactadres van een order of factuur o.b.v. de meegestuurde gegevens.
     *
     * @param array{
     *     OrderId?: int|null,
     *     InvoiceId?: int|null,
     *     ContactAddress?: array{Id?: int|null, ProvinceId?: int|null, ContactName?: string|null, CompanyName?: string|null, PostalCode?: string|null, City?: string|null, CountryCode?: string|null, Street?: string|null, HouseNumber?: string|null, HouseNumberAddition?: string|null}|null,
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
     *     OrderId?: int|null,
     *     InvoiceId?: int|null,
     *     DeliveryAddress?: array{TelephoneNumber?: string|null, Email?: string|null, Street2?: string|null, HouseNumber2?: string|null, HouseNumberAddition2?: string|null, Id?: int|null, ProvinceId?: int|null, ContactName?: string|null, CompanyName?: string|null, PostalCode?: string|null, City?: string|null, CountryCode?: string|null, Street?: string|null, HouseNumber?: string|null, HouseNumberAddition?: string|null}|null,
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
     *     OrderId?: int|null,
     *     InvoiceId?: int|null,
     *     InvoiceAddress?: array{Id?: int|null, ProvinceId?: int|null, ContactName?: string|null, CompanyName?: string|null, PostalCode?: string|null, City?: string|null, CountryCode?: string|null, Street?: string|null, HouseNumber?: string|null, HouseNumberAddition?: string|null}|null,
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
}
