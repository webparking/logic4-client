<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V11;

use Webparking\Logic4Client\Data\V11\Creditor;
use Webparking\Logic4Client\Data\V11\Customer;
use Webparking\Logic4Client\Data\V11\CustomerAddress;
use Webparking\Logic4Client\Data\V11\CustomerContact;
use Webparking\Logic4Client\Data\V11\Representative;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;

class RelationsRequest extends Request
{
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
     * @return \Generator<array-key, CustomerAddress>
     *
     * @throws Logic4ApiException
     */
    public function getAddresses(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1.1/Relations/GetAddresses', $parameters);

        foreach ($iterator as $record) {
            yield CustomerAddress::make($record);
        }
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
     * @return \Generator<array-key, CustomerContact>
     *
     * @throws Logic4ApiException
     */
    public function getContacts(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1.1/Relations/GetContacts', $parameters);

        foreach ($iterator as $record) {
            yield CustomerContact::make($record);
        }
    }

    /**
     * Verkrijg crediteuren o.b.v. het meegestuurde filter.
     *
     * @param array{
     *     SkipRecords?: int,
     *     TakeRecords?: int,
     *     ChangedAfter?: string|null,
     *     Id?: int|null,
     *     PhoneNumber?: string|null,
     *     WebsiteDomainId?: int|null,
     *     EmailAddress?: string|null,
     *     EmailAddressIsExact?: bool,
     * } $parameters
     *
     * @return \Generator<array-key, Creditor>
     *
     * @throws Logic4ApiException
     */
    public function getCreditors(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1.1/Relations/GetCreditors', $parameters);

        foreach ($iterator as $record) {
            yield Creditor::make($record);
        }
    }

    /**
     * Verkrijg debiteuren o.b.v. het meegestuurde filter.
     *
     * @param array{
     *     SkipRecords?: int,
     *     TakeRecords?: int,
     *     ChangedAfter?: string|null,
     *     Id?: int|null,
     *     PhoneNumber?: string|null,
     *     WebsiteDomainId?: int|null,
     *     EmailAddress?: string|null,
     *     EmailAddressIsExact?: bool,
     * } $parameters
     *
     * @return \Generator<array-key, Customer>
     *
     * @throws Logic4ApiException
     */
    public function getCustomers(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1.1/Relations/GetCustomers', $parameters);

        foreach ($iterator as $record) {
            yield Customer::make($record);
        }
    }

    /**
     * Verkrijg alle vertegenwoordigers.
     *
     * @param array{
     *     SkipRecords?: int,
     *     TakeRecords?: int,
     * } $parameters
     *
     * @return \Generator<array-key, Representative>
     *
     * @throws Logic4ApiException
     */
    public function getRepresentatives(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1.1/Relations/GetRepresentatives', $parameters);

        foreach ($iterator as $record) {
            yield Representative::make($record);
        }
    }
}
