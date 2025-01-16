<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V10;

use Webparking\Logic4Client\Data\V10\ContactCharacteristic;
use Webparking\Logic4Client\Data\V10\Creditor;
use Webparking\Logic4Client\Data\V10\CreditorDiscount;
use Webparking\Logic4Client\Data\V10\Customer;
use Webparking\Logic4Client\Data\V10\CustomerAddress;
use Webparking\Logic4Client\Data\V10\CustomerContact;
use Webparking\Logic4Client\Data\V10\DebtorCharacteristic;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V10\AddressTypeLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\BooleanLogic4Response;
use Webparking\Logic4Client\Responses\V10\ContactTypeLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\CreditorDiscountTypeLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\CreditorThirdPartyExternalIdentiferLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\CustomerThirdPartyExternalIdentiferLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\GenderLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\Int32Logic4Response;
use Webparking\Logic4Client\Responses\V10\RelationStatusLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\RelationTypeLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\RepresentativeLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\SecondTypeContactGroupLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\ThirdPartyExternalIdentifierTypeLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\TypeContactGroupLogic4ResponseList;

class RelationsRequest extends Request
{
    /**
     * Crediteur discount toevoegen. Retourneert de Id.
     *
     * @param array{
     *     TypeId?: integer|null,
     *     CreditorId?: integer|null,
     *     BrandId?: integer|null,
     *     DateFrom?: string|null,
     *     DateTo?: string|null,
     *     Percentage?: number|null,
     *     Amount?: number|null,
     *     Remarks?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addCreditorDiscount(
        array $parameters = [],
    ): Int32Logic4Response {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Relations/AddCreditorDiscount', ['json' => $parameters]),
            )
        );
    }

    /**
     * Debiteur toevoegen.
     *
     * @param array{
     *     Id?: integer|null,
     *     IsoCode?: string|null,
     *     CountryCode?: string|null,
     *     CountryId?: integer|null,
     *     CompanyName?: string|null,
     *     FirstName?: string|null,
     *     LastName?: string|null,
     *     EmailAddress?: string|null,
     *     PaymentMethodId?: integer|null,
     *     PricelistIds?: array<integer>|null,
     *     TelephoneNumber?: string|null,
     *     MobileNumber?: string|null,
     *     Faxnumber?: string|null,
     *     ChamberOfCommerceCode?: string|null,
     *     Website?: string|null,
     *     Discount?: number|null,
     *     StandardReportIdForPickingList?: integer|null,
     *     StandardReportIdForSalesOrderDelivery?: integer|null,
     *     City?: string|null,
     *     Zipcode?: string|null,
     *     Street?: string|null,
     *     HouseNumber?: string|null,
     *     HouseNumberAddition?: string|null,
     *     VatNumber?: string|null,
     *     DontPrintPaperInvoiceForDebtor?: boolean|null,
     *     ReceiveInvoiceElectronically?: boolean|null,
     *     ElectronicInvoiceAttachmentType?: integer|null,
     *     StandardInvoiceLayoutReportId?: integer|null,
     *     Preposition?: string|null,
     *     CreditLimit?: number|null,
     *     ShippingMethodId?: integer|null,
     *     GlobalisationId?: integer|null,
     *     VatCodeId?: integer|null,
     *     StatusId?: integer|null,
     *     RepresentativeId?: integer|null,
     *     RelationTypeId?: integer|null,
     *     GenderId?: integer|null,
     *     StandardPackagingSlipLayoutReportId?: integer|null,
     *     FreeValue1?: string|null,
     *     FreeValue2?: string|null,
     *     FreeValue3?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addCustomer(array $parameters = []): Int32Logic4Response
    {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Relations/AddCustomer', ['json' => $parameters]),
            )
        );
    }

    /**
     * Adres toevoegen of updaten.
     *
     * @param array{
     *     Type?: array{Id?: integer, Name?: string|null}|null,
     *     Province?: array{Id?: integer, Name?: string|null}|null,
     *     Email?: string|null,
     *     ContactName?: string|null,
     *     CompanyName?: string|null,
     *     Address1?: string|null,
     *     Address2?: string|null,
     *     Id?: integer|null,
     *     DebtorId?: integer|null,
     *     CreditorId?: integer|null,
     *     IsMainContact?: boolean|null,
     *     IsHidden?: boolean|null,
     *     OwnContactNumber?: string|null,
     *     CountryCode?: string|null,
     *     IsoCode?: string|null,
     *     City?: string|null,
     *     Zipcode?: string|null,
     *     Street?: string|null,
     *     HouseNumber?: string|null,
     *     HouseNumberAddition?: string|null,
     *     TelephoneNumber?: string|null,
     *     CountryId?: integer|null,
     *     ZoneId?: integer|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addUpdateAddress(array $parameters = []): Int32Logic4Response
    {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Relations/AddUpdateAddress', ['json' => $parameters]),
            )
        );
    }

    /**
     * Contactpersoon toevoegen of updaten.
     *
     * @param array{
     *     EmailAddress?: string|null,
     *     FirstName?: string|null,
     *     Function?: string|null,
     *     Gender?: array{Id?: integer, Name?: string|null}|null,
     *     Initials?: string|null,
     *     InsertionName?: string|null,
     *     LastName?: string|null,
     *     MobileNumber?: string|null,
     *     CreatedDateTime?: string|null,
     *     ChangedDateTime?: string|null,
     *     Id?: integer|null,
     *     DebtorId?: integer|null,
     *     CreditorId?: integer|null,
     *     IsMainContact?: boolean|null,
     *     IsHidden?: boolean|null,
     *     OwnContactNumber?: string|null,
     *     CountryCode?: string|null,
     *     IsoCode?: string|null,
     *     City?: string|null,
     *     Zipcode?: string|null,
     *     Street?: string|null,
     *     HouseNumber?: string|null,
     *     HouseNumberAddition?: string|null,
     *     TelephoneNumber?: string|null,
     *     CountryId?: integer|null,
     *     ZoneId?: integer|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addUpdateContact(array $parameters = []): Int32Logic4Response
    {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Relations/AddUpdateContact', ['json' => $parameters]),
            )
        );
    }

    /**
     * Crediteur externe identifier toevoegen of updaten.
     *
     * @param array{
     *     CreditorId?: integer|null,
     *     TypeId?: integer|null,
     *     Value?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addUpdateCreditorThirdPartyExternalIdentifier(
        array $parameters = [],
    ): BooleanLogic4Response {
        return BooleanLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Relations/AddUpdateCreditorThirdPartyExternalIdentifier', ['json' => $parameters]),
            )
        );
    }

    /**
     * Debiteur toevoegen of updaten.
     *
     * @param array{
     *     Id?: integer|null,
     *     IsoCode?: string|null,
     *     CountryCode?: string|null,
     *     CountryId?: integer|null,
     *     CompanyName?: string|null,
     *     FirstName?: string|null,
     *     LastName?: string|null,
     *     EmailAddress?: string|null,
     *     PaymentMethodId?: integer|null,
     *     PricelistIds?: array<integer>|null,
     *     VatCode?: array{Id?: integer, Percent?: number, Name?: string|null}|null,
     *     TelephoneNumber?: string|null,
     *     MobileNumber?: string|null,
     *     Faxnumber?: string|null,
     *     ChamberOfCommerceCode?: string|null,
     *     Website?: string|null,
     *     Status?: array{Id?: integer, Description?: string|null}|null,
     *     Discount?: number|null,
     *     Representative?: array{Id?: integer, Name?: string|null}|null,
     *     Type?: array{Id?: integer, Description?: string|null}|null,
     *     StandardReportIdForPickingList?: integer|null,
     *     StandardReportIdForSalesOrderDelivery?: integer|null,
     *     City?: string|null,
     *     Zipcode?: string|null,
     *     Street?: string|null,
     *     HouseNumber?: string|null,
     *     HouseNumberAddition?: string|null,
     *     VatNumber?: string|null,
     *     DontPrintPaperInvoiceForDebtor?: boolean|null,
     *     ReceiveInvoiceElectronically?: boolean|null,
     *     ElectronicInvoiceAttachmentType?: integer|null,
     *     StandardInvoiceLayoutReportId?: integer|null,
     *     Gender?: array{Id?: integer, Name?: string|null}|null,
     *     Preposition?: string|null,
     *     CreditLimit?: number|null,
     *     ShippingMethodId?: integer|null,
     *     GlobalisationId?: integer|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     *
     * @deprecated Let op! Versie 1.0 is verouderd. Gebruik een nieuwere versie. - Debiteur toevoegen of updaten.
     * Gebruik als alternatief de gesplitste functies UpdateCustomer en AddCustomer.
     */
    public function addUpdateCustomer(array $parameters = []): Int32Logic4Response
    {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Relations/AddUpdateCustomer', ['json' => $parameters]),
            )
        );
    }

    /**
     * Debiteur externe identifier toevoegen of updaten.
     *
     * @param array{
     *     DebtorId?: integer|null,
     *     TypeId?: integer|null,
     *     Value?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addUpdateCustomerThirdPartyExternalIdentifier(
        array $parameters = [],
    ): BooleanLogic4Response {
        return BooleanLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Relations/AddUpdateCustomerThirdPartyExternalIdentifier', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verwijder een crediteur derde partij externe identifier.
     *
     * @param array{
     *     CreditorId?: integer|null,
     *     TypeId?: integer|null,
     *     Value?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function deleteCreditorThirdPartyExternalIdentifier(
        array $parameters = [],
    ): BooleanLogic4Response {
        return BooleanLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Relations/DeleteCreditorThirdPartyExternalIdentifier', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verwijder een debiteur derde partij externe identifier.
     *
     * @param array{
     *     DebtorId?: integer|null,
     *     TypeId?: integer|null,
     *     Value?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function deleteCustomerThirdPartyExternalIdentifier(
        array $parameters = [],
    ): BooleanLogic4Response {
        return BooleanLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Relations/DeleteCustomerThirdPartyExternalIdentifier', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg adressen o.b.v. het meegestuurde filter.
     *
     * @param array{
     *     SkipRecords?: integer|null,
     *     TakeRecords?: integer|null,
     *     Id?: integer|null,
     *     AddressTypeId?: integer|null,
     *     PhoneNumber?: string|null,
     *     DebtorId?: integer|null,
     *     CreditorId?: integer|null,
     *     ExcludeHiddenContacts?: boolean|null,
     *     OwnContactNumber?: string|null,
     * } $parameters
     *
     * @return \Generator<array-key, CustomerAddress>
     *
     * @throws Logic4ApiException
     *
     * @deprecated Let op! Versie 1.0 is verouderd. Gebruik versie v1.1. - Adressen ophalen
     */
    public function getAddresses(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1/Relations/GetAddresses', $parameters);

        foreach ($iterator as $record) {
            yield CustomerAddress::make($record);
        }
    }

    /**
     * Verkrijg alle adrestypes.
     *
     * @throws Logic4ApiException
     */
    public function getAddressTypes(): AddressTypeLogic4ResponseList
    {
        return AddressTypeLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Relations/GetAddressTypes'),
            )
        );
    }

    /**
     * Verkrijg contacten o.b.v. het meegestuurde filter.
     *
     * @param array{
     *     SkipRecords?: integer|null,
     *     TakeRecords?: integer|null,
     *     Id?: integer|null,
     *     AddressTypeId?: integer|null,
     *     PhoneNumber?: string|null,
     *     DebtorId?: integer|null,
     *     CreditorId?: integer|null,
     *     ExcludeHiddenContacts?: boolean|null,
     *     OwnContactNumber?: string|null,
     * } $parameters
     *
     * @return \Generator<array-key, CustomerContact>
     *
     * @throws Logic4ApiException
     *
     * @deprecated Let op! Versie 1.0 is verouderd. Gebruik versie v1.1. - Contacten ophalen
     */
    public function getContacts(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1/Relations/GetContacts', $parameters);

        foreach ($iterator as $record) {
            yield CustomerContact::make($record);
        }
    }

    /**
     * @param array{
     *     ContactIds?: array<integer>|null,
     *     DebtorId?: integer|null,
     *     ContactType?: string|null,
     *     LastCharacteristicChangeDateTime?: string|null,
     *     SkipRecords?: integer|null,
     *     TakeRecords?: integer|null,
     * } $parameters
     *
     * @return \Generator<array-key, ContactCharacteristic>
     *
     * @throws Logic4ApiException
     */
    public function getContactsCharacteristics(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1/Relations/GetContactsCharacteristics', $parameters);

        foreach ($iterator as $record) {
            yield ContactCharacteristic::make($record);
        }
    }

    /**
     * @throws Logic4ApiException
     */
    public function getContactTypes(): ContactTypeLogic4ResponseList
    {
        return ContactTypeLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Relations/GetContactTypes'),
            )
        );
    }

    /**
     * Crediteur discounts ophalen (maximaal 1000).
     *
     * @param array{
     *     SkipRecords?: integer|null,
     *     TakeRecords?: integer|null,
     *     Ids?: array<integer>|null,
     * } $parameters
     *
     * @return \Generator<array-key, CreditorDiscount>
     *
     * @throws Logic4ApiException
     */
    public function getCreditorDiscounts(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1/Relations/GetCreditorDiscounts', $parameters);

        foreach ($iterator as $record) {
            yield CreditorDiscount::make($record);
        }
    }

    /**
     * Crediteur discount types ophalen.
     *
     * @throws Logic4ApiException
     */
    public function getCreditorDiscountTypes(
    ): CreditorDiscountTypeLogic4ResponseList {
        return CreditorDiscountTypeLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Relations/GetCreditorDiscountTypes'),
            )
        );
    }

    /**
     * Verkrijg crediteuren o.b.v. het meegestuurde filter.
     *
     * @param array{
     *     SkipRecords?: integer|null,
     *     TakeRecords?: integer|null,
     *     Id?: integer|null,
     *     PhoneNumber?: string|null,
     *     WebsiteDomainId?: integer|null,
     *     EmailAddress?: string|null,
     *     EmailAddressIsExact?: boolean|null,
     * } $parameters
     *
     * @return \Generator<array-key, Creditor>
     *
     * @throws Logic4ApiException
     *
     * @deprecated Let op! Versie 1.0 is verouderd. Gebruik versie v1.1. - Crediteuren ophalen
     */
    public function getCreditors(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1/Relations/GetCreditors', $parameters);

        foreach ($iterator as $record) {
            yield Creditor::make($record);
        }
    }

    /**
     * Verkrijg crediteur externe identifiers o.b.v. het meegestuurde filter.
     *
     * @param array{
     *     CreditorId?: integer|null,
     *     TypeId?: integer|null,
     *     Value?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getCreditorThirdPartyExternalIdentifiers(
        array $parameters = [],
    ): CreditorThirdPartyExternalIdentiferLogic4ResponseList {
        return CreditorThirdPartyExternalIdentiferLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Relations/GetCreditorThirdPartyExternalIdentifiers', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg debiteuren o.b.v. het meegestuurde filter.
     *
     * @param array{
     *     SkipRecords?: integer|null,
     *     TakeRecords?: integer|null,
     *     Id?: integer|null,
     *     PhoneNumber?: string|null,
     *     WebsiteDomainId?: integer|null,
     *     EmailAddress?: string|null,
     *     EmailAddressIsExact?: boolean|null,
     * } $parameters
     *
     * @return \Generator<array-key, Customer>
     *
     * @throws Logic4ApiException
     *
     * @deprecated Let op! Versie 1.0 is verouderd. Gebruik versie v1.1. - Debiteuren ophalen
     */
    public function getCustomers(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1/Relations/GetCustomers', $parameters);

        foreach ($iterator as $record) {
            yield Customer::make($record);
        }
    }

    /**
     * @param array{
     *     DebtorIds?: array<integer>|null,
     *     LastCharacteristicChangeDateTime?: string|null,
     *     SkipRecords?: integer|null,
     *     TakeRecords?: integer|null,
     * } $parameters
     *
     * @return \Generator<array-key, DebtorCharacteristic>
     *
     * @throws Logic4ApiException
     */
    public function getCustomersCharacteristics(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1/Relations/GetCustomersCharacteristics', $parameters);

        foreach ($iterator as $record) {
            yield DebtorCharacteristic::make($record);
        }
    }

    /**
     * Verkrijg debiteur externe identifiers o.b.v. het meegestuurde filter.
     *
     * @param array{
     *     DebtorId?: integer|null,
     *     TypeId?: integer|null,
     *     Value?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getCustomerThirdPartyExternalIdentifiers(
        array $parameters = [],
    ): CustomerThirdPartyExternalIdentiferLogic4ResponseList {
        return CustomerThirdPartyExternalIdentiferLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Relations/GetCustomerThirdPartyExternalIdentifiers', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg alle geslachttypes.
     *
     * @throws Logic4ApiException
     */
    public function getGenders(): GenderLogic4ResponseList
    {
        return GenderLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Relations/GetGenders'),
            )
        );
    }

    /**
     * Verkrijg alle relatiestatussen.
     *
     * @throws Logic4ApiException
     */
    public function getRelationStatuses(): RelationStatusLogic4ResponseList
    {
        return RelationStatusLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Relations/GetRelationStatuses'),
            )
        );
    }

    /**
     * Verkrijg alle relatietypes.
     *
     * @throws Logic4ApiException
     */
    public function getRelationTypes(): RelationTypeLogic4ResponseList
    {
        return RelationTypeLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Relations/GetRelationTypes'),
            )
        );
    }

    /**
     * Verkrijg alle vertegenwoordigers.
     *
     * @throws Logic4ApiException
     *
     * @deprecated Let op! Versie 1.0 is verouderd. Gebruik versie v1.1. - Vertegenwoordigers ophalen
     */
    public function getRepresentatives(): RepresentativeLogic4ResponseList
    {
        return RepresentativeLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Relations/GetRepresentatives'),
            )
        );
    }

    /**
     * Verkrijg alle typen tweede relatiecontacten.
     *
     * @throws Logic4ApiException
     */
    public function getSecondContactGroupTypes(
    ): SecondTypeContactGroupLogic4ResponseList {
        return SecondTypeContactGroupLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Relations/GetSecondContactGroupTypes'),
            )
        );
    }

    /**
     * Verkrijg alle externe identifiertypes.
     *
     * @throws Logic4ApiException
     */
    public function getThirdPartyExternalIdentfierTypes(
    ): ThirdPartyExternalIdentifierTypeLogic4ResponseList {
        return ThirdPartyExternalIdentifierTypeLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Relations/GetThirdPartyExternalIdentfierTypes'),
            )
        );
    }

    /**
     * Verkrijg alle relatiegroepen.
     *
     * @throws Logic4ApiException
     */
    public function getTypeContactGroups(): TypeContactGroupLogic4ResponseList
    {
        return TypeContactGroupLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Relations/GetTypeContactGroups'),
            )
        );
    }

    /**
     * Crediteur discount updaten. Retourneert true indien succesvol.
     *
     * @param array{
     *     Id?: integer|null,
     *     TypeId?: integer|null,
     *     CreditorId?: integer|null,
     *     BrandId?: integer|null,
     *     DateFrom?: string|null,
     *     DateTo?: string|null,
     *     Percentage?: number|null,
     *     Amount?: number|null,
     *     Remarks?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function updateCreditorDiscount(
        array $parameters = [],
    ): BooleanLogic4Response {
        return BooleanLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Relations/UpdateCreditorDiscount', ['json' => $parameters]),
            )
        );
    }

    /**
     * Waarden van een bestaande debiteur updaten.
     *
     * @param array{
     *     Id?: integer|null,
     *     IsoCode?: string|null,
     *     CountryCode?: string|null,
     *     CountryId?: integer|null,
     *     CompanyName?: string|null,
     *     FirstName?: string|null,
     *     LastName?: string|null,
     *     EmailAddress?: string|null,
     *     PaymentMethodId?: integer|null,
     *     PricelistIds?: array<integer>|null,
     *     TelephoneNumber?: string|null,
     *     MobileNumber?: string|null,
     *     Faxnumber?: string|null,
     *     ChamberOfCommerceCode?: string|null,
     *     Website?: string|null,
     *     Discount?: number|null,
     *     StandardReportIdForPickingList?: integer|null,
     *     StandardReportIdForSalesOrderDelivery?: integer|null,
     *     City?: string|null,
     *     Zipcode?: string|null,
     *     Street?: string|null,
     *     HouseNumber?: string|null,
     *     HouseNumberAddition?: string|null,
     *     VatNumber?: string|null,
     *     DontPrintPaperInvoiceForDebtor?: boolean|null,
     *     ReceiveInvoiceElectronically?: boolean|null,
     *     ElectronicInvoiceAttachmentType?: integer|null,
     *     StandardInvoiceLayoutReportId?: integer|null,
     *     Preposition?: string|null,
     *     CreditLimit?: number|null,
     *     ShippingMethodId?: integer|null,
     *     GlobalisationId?: integer|null,
     *     VatCodeId?: integer|null,
     *     StatusId?: integer|null,
     *     RepresentativeId?: integer|null,
     *     RelationTypeId?: integer|null,
     *     GenderId?: integer|null,
     *     StandardPackagingSlipLayoutReportId?: integer|null,
     *     FreeValue1?: string|null,
     *     FreeValue2?: string|null,
     *     FreeValue3?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function updateCustomer(array $parameters = []): Int32Logic4Response
    {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->patch('/v1/Relations/UpdateCustomer', ['json' => $parameters]),
            )
        );
    }
}
