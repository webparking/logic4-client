<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V12;

use Webparking\Logic4Client\Data\Order;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\Int32Logic4Response;

class OrderRequest extends Request
{
    /**
     * Wijzig of maak een nieuwe order aan, het is alleen mogelijk om stamgegevens van een order te updaten (status, NAW, betaal/verzendmethode).
     * Orderregels kunnen slechts eenmalig bij het aanmaken van de order gevuld worden.
     * Bij het succesvol aanmaken/updaten wordt het (nieuwe) ordernummer in de response gevuld.
     * Met v1.2 of hoger kan het Id van het afleveradres gebruikt worden om het afleveradres te bepalen.
     *
     * @param array{
     *     Totals?: array{AmountEx?: number, VATPercentage?: number, Calc_TotalPayed?: number, AmountIncl?: number, IsPaid?: boolean, ShippingCost?: number, ShippingCostIncl?: number}|null,
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
     * @deprecated Let op! Versie 1.2 is verouderd. Gebruik versie v1.3. - Order toevoegen of updaten
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
}
