<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V12;

use Webparking\Logic4Client\Data\V12\Order;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V12\Int32Logic4Response;

class OrderRequest extends Request
{
    /**
     * Wijzig of maak een nieuwe order aan, het is alleen mogelijk om stamgegevens van een order te updaten (status, NAW, betaal/verzendmethode).
     * Orderregels kunnen slechts eenmalig bij het aanmaken van de order gevuld worden.
     * Bij het succesvol aanmaken/updaten wordt het (nieuwe) ordernummer in de response gevuld.
     * Met v1.2 of hoger kan het Id van het afleveradres gebruikt worden om het afleveradres te bepalen.
     *
     * @param array{
     *     Totals?: array{AmountEx?: number, VATPercentage?: number, Calc_TotalPayed?: number|null, AmountIncl?: number, IsPaid?: bool, ShippingCost?: number, ShippingCostIncl?: number|null},
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
