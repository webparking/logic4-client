<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V30;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V30\AddressType;
use Webparking\Logic4Client\Responses\V30\ContactCharacteristic;
use Webparking\Logic4Client\Responses\V30\ContactType;
use Webparking\Logic4Client\Responses\V30\Creditor;
use Webparking\Logic4Client\Responses\V30\CreditorDiscount;
use Webparking\Logic4Client\Responses\V30\CreditorDiscountType;
use Webparking\Logic4Client\Responses\V30\CreditorThirdPartyExternalIdentifer;
use Webparking\Logic4Client\Responses\V30\Customer;
use Webparking\Logic4Client\Responses\V30\CustomerAddress;
use Webparking\Logic4Client\Responses\V30\CustomerContact;
use Webparking\Logic4Client\Responses\V30\CustomerThirdPartyExternalIdentifer;
use Webparking\Logic4Client\Responses\V30\DebtorCharacteristic;
use Webparking\Logic4Client\Responses\V30\DebtorWebsiteDomainsList;
use Webparking\Logic4Client\Responses\V30\Gender;
use Webparking\Logic4Client\Responses\V30\RelationStatus;
use Webparking\Logic4Client\Responses\V30\RelationType;
use Webparking\Logic4Client\Responses\V30\Representative;
use Webparking\Logic4Client\Responses\V30\SecondTypeContactGroup;
use Webparking\Logic4Client\Responses\V30\ThirdPartyExternalIdentifierType;
use Webparking\Logic4Client\Responses\V30\TypeContactGroup;

class RelationsRequest extends Request
{
    /**
     * Crediteur discount toevoegen. Retourneert de Id.
     *
     * @param array{
     *     TypeId?: int,
     *     CreditorId?: int,
     *     BrandId?: int,
     *     DateFrom?: string|null,
     *     DateTo?: string|null,
     *     Percentage?: number|null,
     *     Amount?: number|null,
     *     Remarks?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addCreditorDiscount(array $parameters = []): int
    {
        return $this->buildResponse(
            $this->getClient()->post('/v3/Relations/AddCreditorDiscount', ['json' => $parameters]),
        );
    }

    /**
     * Debiteur toevoegen. Mogelijke fouten (status en type):
     * - 400 `tag:api.logic4.nl:2025-08-16:InvalidRequest`
     *   - Algemene validatiefout.
     * - 400 `tag:api.logic4.nl:2026-02-03:InvalidVatFormat`
     *   - Het BTW-nummer heeft een ongeldig formaat en de VIES BTW-nummer validatieservice is niet aangeroepen.
     * - 400 `tag:api.logic4.nl:2026-02-03:InvalidVatNumber`
     *   - De VIES BTW-nummer validatieservice geeft 'ongeldig BTW-nummer'.
     * - 424 `tag:api.logic4.nl:2026-02-03:ViesNotAvailable`
     *   - De VIES BTW-nummer validatieservice is niet bereikbaar.
     *
     * @param array{
     *     Id?: int|null,
     *     ValidateVat?: bool,
     *     IsoCode?: string|null,
     *     CountryCode?: string|null,
     *     CountryId?: int,
     *     CompanyName?: string|null,
     *     FirstName?: string|null,
     *     LastName?: string|null,
     *     EmailAddress?: string|null,
     *     LoginName?: string|null,
     *     PaymentMethodId?: int|null,
     *     PricelistIds?: array<int>,
     *     TelephoneNumber?: string|null,
     *     MobileNumber?: string|null,
     *     Faxnumber?: string|null,
     *     ChamberOfCommerceCode?: string|null,
     *     Website?: string|null,
     *     Discount?: number|null,
     *     StandardReportIdForPickingList?: int|null,
     *     StandardReportIdForSalesOrderDelivery?: int|null,
     *     City?: string|null,
     *     Zipcode?: string|null,
     *     Street?: string|null,
     *     HouseNumber?: string|null,
     *     HouseNumberAddition?: string|null,
     *     VatNumber?: string|null,
     *     DontPrintPaperInvoiceForDebtor?: bool,
     *     ReceiveInvoiceElectronically?: bool,
     *     ElectronicInvoiceAttachmentType?: int|null,
     *     StandardInvoiceLayoutReportId?: int|null,
     *     Preposition?: string|null,
     *     CreditLimit?: number|null,
     *     ShippingMethodId?: int|null,
     *     GlobalisationId?: int|null,
     *     VatCodeId?: int|null,
     *     StatusId?: int|null,
     *     RepresentativeId?: int|null,
     *     RelationTypeId?: int|null,
     *     GenderId?: int|null,
     *     StandardPackagingSlipLayoutReportId?: int|null,
     *     FreeValue1?: string|null,
     *     FreeValue2?: string|null,
     *     FreeValue3?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addCustomer(array $parameters = []): int
    {
        return $this->buildResponse(
            $this->getClient()->post('/v3/Relations/AddCustomer', ['json' => $parameters]),
        );
    }

    /**
     * Adres toevoegen of updaten.
     *
     * @param array{
     *     Type?: array{Id?: int, Name?: string|null},
     *     Province?: array{Id?: int, Name?: string|null},
     *     Email?: string|null,
     *     ContactName?: string|null,
     *     CompanyName?: string|null,
     *     Address1?: string|null,
     *     Address2?: string|null,
     *     Id?: int|null,
     *     DebtorId?: int|null,
     *     CreditorId?: int|null,
     *     IsMainContact?: bool,
     *     IsHidden?: bool|null,
     *     OwnContactNumber?: string|null,
     *     CountryCode?: string|null,
     *     IsoCode?: string|null,
     *     City?: string|null,
     *     Zipcode?: string|null,
     *     Street?: string|null,
     *     HouseNumber?: string|null,
     *     HouseNumberAddition?: string|null,
     *     TelephoneNumber?: string|null,
     *     CountryId?: int,
     *     ZoneId?: int,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addUpdateAddress(array $parameters = []): int
    {
        return $this->buildResponse(
            $this->getClient()->post('/v3/Relations/AddUpdateAddress', ['json' => $parameters]),
        );
    }

    /**
     * Contactpersoon toevoegen of updaten.
     *
     * @param array{
     *     EmailAddress?: string|null,
     *     FirstName?: string|null,
     *     Function?: string|null,
     *     Gender?: array{Id?: int, Name?: string|null},
     *     Initials?: string|null,
     *     InsertionName?: string|null,
     *     LastName?: string|null,
     *     MobileNumber?: string|null,
     *     CreatedDateTime?: string|null,
     *     ChangedDateTime?: string|null,
     *     Id?: int|null,
     *     DebtorId?: int|null,
     *     CreditorId?: int|null,
     *     IsMainContact?: bool,
     *     IsHidden?: bool|null,
     *     OwnContactNumber?: string|null,
     *     CountryCode?: string|null,
     *     IsoCode?: string|null,
     *     City?: string|null,
     *     Zipcode?: string|null,
     *     Street?: string|null,
     *     HouseNumber?: string|null,
     *     HouseNumberAddition?: string|null,
     *     TelephoneNumber?: string|null,
     *     CountryId?: int,
     *     ZoneId?: int,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addUpdateContact(array $parameters = []): int
    {
        return $this->buildResponse(
            $this->getClient()->post('/v3/Relations/AddUpdateContact', ['json' => $parameters]),
        );
    }

    /**
     * Crediteur externe identifier toevoegen of updaten.
     *
     * @param array{
     *     CreditorId?: int,
     *     TypeId?: int,
     *     Value?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addUpdateCreditorThirdPartyExternalIdentifier(array $parameters = []): void
    {
        $this->getClient()->post('/v3/Relations/AddUpdateCreditorThirdPartyExternalIdentifier', ['json' => $parameters]);
    }

    /**
     * Debiteur externe identifier toevoegen of updaten.
     *
     * @param array{
     *     DebtorId?: int,
     *     TypeId?: int,
     *     Value?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addUpdateCustomerThirdPartyExternalIdentifier(array $parameters = []): void
    {
        $this->getClient()->post('/v3/Relations/AddUpdateCustomerThirdPartyExternalIdentifier', ['json' => $parameters]);
    }

    /**
     * Voeg één of meer websitedomein Id's toe aan een debiteur. Geeft aantal toegevoegde Id's terug.
     *
     * @param array{
     *     DebtorId?: int,
     *     WebsiteDomainIds?: array<int>,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addWebsiteDomains(array $parameters = []): int
    {
        return $this->buildResponse(
            $this->getClient()->post('/v3/Relations/AddWebsiteDomains', ['json' => $parameters]),
        );
    }

    /**
     * Verwijder een crediteur derde partij externe identifier.
     *
     * @param array{
     *     CreditorId?: int|null,
     *     TypeId?: int|null,
     *     Value?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function deleteCreditorThirdPartyExternalIdentifier(array $parameters = []): void
    {
        $this->getClient()->post('/v3/Relations/DeleteCreditorThirdPartyExternalIdentifier', ['json' => $parameters]);
    }

    /**
     * Verwijder een debiteur derde partij externe identifier.
     *
     * @param array{
     *     DebtorId?: int|null,
     *     TypeId?: int|null,
     *     Value?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function deleteCustomerThirdPartyExternalIdentifier(array $parameters = []): void
    {
        $this->getClient()->post('/v3/Relations/DeleteCustomerThirdPartyExternalIdentifier', ['json' => $parameters]);
    }

    /**
     * Verwijder één of meer websitedomein Id's van een debiteur. Geeft aantal verwijderde Id's terug.
     *
     * @param array{
     *     DebtorId?: int,
     *     WebsiteDomainIds?: array<int>,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function deleteWebsiteDomains(array $parameters = []): int
    {
        return $this->buildResponse(
            $this->getClient()->post('/v3/Relations/DeleteWebsiteDomains', ['json' => $parameters]),
        );
    }

    /**
     * Verkrijg adressen o.b.v. het meegestuurde filter.
     *
     * @param array{
     *     SkipRecords?: int,
     *     TakeRecords?: int,
     *     ChangedAfter?: string|null,
     *     Id?: int|null,
     *     AddressTypeId?: int|null,
     *     PhoneNumber?: string|null,
     *     DebtorId?: int|null,
     *     CreditorId?: int|null,
     *     ExcludeHiddenContacts?: bool,
     *     OwnContactNumber?: string|null,
     * } $parameters
     *
     * @return array<array-key, CustomerAddress>
     *
     * @throws Logic4ApiException
     */
    public function getAddresses(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => CustomerAddress::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Relations/GetAddresses', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Verkrijg alle adrestypes.
     *
     * @return array<array-key, AddressType>
     *
     * @throws Logic4ApiException
     */
    public function getAddressTypes(): array
    {
        return array_map(
            static fn (array $data) => AddressType::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/Relations/GetAddressTypes'),
            ),
        );
    }

    /**
     * Verkrijg contacten o.b.v. het meegestuurde filter.
     *
     * @param array{
     *     SkipRecords?: int,
     *     TakeRecords?: int,
     *     ChangedAfter?: string|null,
     *     Id?: int|null,
     *     AddressTypeId?: int|null,
     *     PhoneNumber?: string|null,
     *     DebtorId?: int|null,
     *     CreditorId?: int|null,
     *     ExcludeHiddenContacts?: bool,
     *     OwnContactNumber?: string|null,
     * } $parameters
     *
     * @return array<array-key, CustomerContact>
     *
     * @throws Logic4ApiException
     */
    public function getContacts(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => CustomerContact::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Relations/GetContacts', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Haal kenmerken met bijbehorende vertegenwoordiger op voor contacten.
     *
     * @param array{
     *     ContactIds?: array<int>,
     *     DebtorId?: int|null,
     *     ContactType?: mixed,
     *     LastCharacteristicChangeDateTime?: string|null,
     *     SkipRecords?: int,
     *     TakeRecords?: int,
     * } $parameters
     *
     * @return array<array-key, ContactCharacteristic>
     *
     * @throws Logic4ApiException
     */
    public function getContactsCharacteristics(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => ContactCharacteristic::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Relations/GetContactsCharacteristics', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Contact types ophalen.
     *
     * @return array<array-key, ContactType>
     *
     * @throws Logic4ApiException
     */
    public function getContactTypes(): array
    {
        return array_map(
            static fn (array $data) => ContactType::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/Relations/GetContactTypes'),
            ),
        );
    }

    /**
     * Crediteur discounts ophalen (maximaal 1000).
     *
     * @param array{
     *     SkipRecords?: int,
     *     TakeRecords?: int,
     *     Ids?: array<int>,
     * } $parameters
     *
     * @return array<array-key, CreditorDiscount>
     *
     * @throws Logic4ApiException
     */
    public function getCreditorDiscounts(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => CreditorDiscount::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Relations/GetCreditorDiscounts', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Crediteur discount types ophalen.
     *
     * @return array<array-key, CreditorDiscountType>
     *
     * @throws Logic4ApiException
     */
    public function getCreditorDiscountTypes(): array
    {
        return array_map(
            static fn (array $data) => CreditorDiscountType::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/Relations/GetCreditorDiscountTypes'),
            ),
        );
    }

    /**
     * Verkrijg crediteuren o.b.v. het meegestuurde filter.
     *
     * @param array{
     *     SkipRecords?: int,
     *     TakeRecords?: int,
     *     ChangedAfter?: string|null,
     *     LoginName?: string|null,
     *     Id?: int|null,
     *     PhoneNumber?: string|null,
     *     WebsiteDomainId?: int|null,
     *     EmailAddress?: string|null,
     *     EmailAddressIsExact?: bool,
     * } $parameters
     *
     * @return array<array-key, Creditor>
     *
     * @throws Logic4ApiException
     */
    public function getCreditors(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => Creditor::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Relations/GetCreditors', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Verkrijg crediteur externe identifiers o.b.v. het meegestuurde filter.
     *
     * @param array{
     *     CreditorId?: int|null,
     *     TypeId?: int|null,
     *     Value?: string|null,
     * } $parameters
     *
     * @return array<array-key, CreditorThirdPartyExternalIdentifer>
     *
     * @throws Logic4ApiException
     */
    public function getCreditorThirdPartyExternalIdentifiers(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => CreditorThirdPartyExternalIdentifer::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Relations/GetCreditorThirdPartyExternalIdentifiers', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Verkrijg debiteuren o.b.v. het meegestuurde filter.
     *
     * @param array{
     *     SkipRecords?: int,
     *     TakeRecords?: int,
     *     ChangedAfter?: string|null,
     *     LoginName?: string|null,
     *     Id?: int|null,
     *     PhoneNumber?: string|null,
     *     WebsiteDomainId?: int|null,
     *     EmailAddress?: string|null,
     *     EmailAddressIsExact?: bool,
     * } $parameters
     *
     * @return array<array-key, Customer>
     *
     * @throws Logic4ApiException
     */
    public function getCustomers(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => Customer::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Relations/GetCustomers', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Haal kenmerken met bijbehorende vertegenwoordiger op voor debiteuren.
     *
     * @param array{
     *     DebtorIds?: array<int>,
     *     LastCharacteristicChangeDateTime?: string|null,
     *     SkipRecords?: int,
     *     TakeRecords?: int,
     * } $parameters
     *
     * @return array<array-key, DebtorCharacteristic>
     *
     * @throws Logic4ApiException
     */
    public function getCustomersCharacteristics(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => DebtorCharacteristic::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Relations/GetCustomersCharacteristics', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Verkrijg debiteur externe identifiers o.b.v. het meegestuurde filter.
     *
     * @param array{
     *     DebtorId?: int|null,
     *     TypeId?: int|null,
     *     Value?: string|null,
     * } $parameters
     *
     * @return array<array-key, CustomerThirdPartyExternalIdentifer>
     *
     * @throws Logic4ApiException
     */
    public function getCustomerThirdPartyExternalIdentifiers(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => CustomerThirdPartyExternalIdentifer::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Relations/GetCustomerThirdPartyExternalIdentifiers', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Verkrijg alle geslachttypes.
     *
     * @return array<array-key, Gender>
     *
     * @throws Logic4ApiException
     */
    public function getGenders(): array
    {
        return array_map(
            static fn (array $data) => Gender::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/Relations/GetGenders'),
            ),
        );
    }

    /**
     * Verkrijg alle relatiestatussen.
     *
     * @return array<array-key, RelationStatus>
     *
     * @throws Logic4ApiException
     */
    public function getRelationStatuses(): array
    {
        return array_map(
            static fn (array $data) => RelationStatus::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/Relations/GetRelationStatuses'),
            ),
        );
    }

    /**
     * Verkrijg alle relatietypes.
     *
     * @return array<array-key, RelationType>
     *
     * @throws Logic4ApiException
     */
    public function getRelationTypes(): array
    {
        return array_map(
            static fn (array $data) => RelationType::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/Relations/GetRelationTypes'),
            ),
        );
    }

    /**
     * Verkrijg alle vertegenwoordigers.
     *
     * @param array{
     *     SkipRecords?: int,
     *     TakeRecords?: int,
     * } $parameters
     *
     * @return array<array-key, Representative>
     *
     * @throws Logic4ApiException
     */
    public function getRepresentatives(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => Representative::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Relations/GetRepresentatives', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Verkrijg alle typen tweede relatiecontacten.
     *
     * @return array<array-key, SecondTypeContactGroup>
     *
     * @throws Logic4ApiException
     */
    public function getSecondContactGroupTypes(): array
    {
        return array_map(
            static fn (array $data) => SecondTypeContactGroup::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/Relations/GetSecondContactGroupTypes'),
            ),
        );
    }

    /**
     * Verkrijg alle externe identifiertypes.
     *
     * @return array<array-key, ThirdPartyExternalIdentifierType>
     *
     * @throws Logic4ApiException
     */
    public function getThirdPartyExternalIdentfierTypes(): array
    {
        return array_map(
            static fn (array $data) => ThirdPartyExternalIdentifierType::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/Relations/GetThirdPartyExternalIdentfierTypes'),
            ),
        );
    }

    /**
     * Verkrijg alle relatiegroepen.
     *
     * @return array<array-key, TypeContactGroup>
     *
     * @throws Logic4ApiException
     */
    public function getTypeContactGroups(): array
    {
        return array_map(
            static fn (array $data) => TypeContactGroup::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/Relations/GetTypeContactGroups'),
            ),
        );
    }

    /**
     * Verkrijg websitedomein Id's van een debiteur o.b.v. het meegestuurde filter.
     *
     * @param array{
     *     DebtorId?: int,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getWebsiteDomains(
        array $parameters = [],
    ): DebtorWebsiteDomainsList {
        return DebtorWebsiteDomainsList::make(
            $this->buildResponse(
                $this->getClient()->post('/v3/Relations/GetWebsiteDomains', ['json' => $parameters]),
            )
        );
    }

    /**
     * Crediteur discount updaten. Retourneert true indien succesvol.
     *
     * @param array{
     *     Id?: int,
     *     TypeId?: int,
     *     CreditorId?: int,
     *     BrandId?: int,
     *     DateFrom?: string|null,
     *     DateTo?: string|null,
     *     Percentage?: number|null,
     *     Amount?: number|null,
     *     Remarks?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function updateCreditorDiscount(array $parameters = []): void
    {
        $this->getClient()->post('/v3/Relations/UpdateCreditorDiscount', ['json' => $parameters]);
    }

    /**
     * Waarden van een bestaande debiteur updaten.
     *
     * @param array{
     *     Id?: int,
     *     IsoCode?: string|null,
     *     CountryCode?: string|null,
     *     CountryId?: int,
     *     CompanyName?: string|null,
     *     FirstName?: string|null,
     *     LastName?: string|null,
     *     EmailAddress?: string|null,
     *     LoginName?: string|null,
     *     PaymentMethodId?: int|null,
     *     PricelistIds?: array<int>,
     *     TelephoneNumber?: string|null,
     *     MobileNumber?: string|null,
     *     Faxnumber?: string|null,
     *     ChamberOfCommerceCode?: string|null,
     *     Website?: string|null,
     *     Discount?: number|null,
     *     StandardReportIdForPickingList?: int|null,
     *     StandardReportIdForSalesOrderDelivery?: int|null,
     *     City?: string|null,
     *     Zipcode?: string|null,
     *     Street?: string|null,
     *     HouseNumber?: string|null,
     *     HouseNumberAddition?: string|null,
     *     VatNumber?: string|null,
     *     DontPrintPaperInvoiceForDebtor?: bool,
     *     ReceiveInvoiceElectronically?: bool,
     *     ElectronicInvoiceAttachmentType?: int|null,
     *     StandardInvoiceLayoutReportId?: int|null,
     *     Preposition?: string|null,
     *     CreditLimit?: number|null,
     *     ShippingMethodId?: int|null,
     *     GlobalisationId?: int|null,
     *     VatCodeId?: int|null,
     *     StatusId?: int|null,
     *     RepresentativeId?: int|null,
     *     RelationTypeId?: int|null,
     *     GenderId?: int|null,
     *     StandardPackagingSlipLayoutReportId?: int|null,
     *     FreeValue1?: string|null,
     *     FreeValue2?: string|null,
     *     FreeValue3?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function updateCustomer(array $parameters = []): void
    {
        $this->getClient()->patch('/v3/Relations/UpdateCustomer', ['json' => $parameters]);
    }
}
