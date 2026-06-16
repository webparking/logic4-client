<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V30;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V30\ProductSalesInformation;
use Webparking\Logic4Client\Responses\V30\Top10Item;
use Webparking\Logic4Client\Responses\V30\ValuevsBudget;

class ManagementRequest extends Request
{
    /**
     * Verkrijg van één of meerdere artikelen verkoop gegevens zoals verkoopaantallen, over een bepaalde periode (dag/week/maand/kwartaal/jaar).
     *
     * @param array{
     *     TimeFrame?: mixed,
     *     HistoryPoints?: int,
     *     ProductCodes?: array<string>,
     *     IncludingCurrentPeriod?: bool,
     *     ExcludeDebtorIds?: array<int>,
     *     WebSiteDomainsIds?: array<int>,
     * } $parameters
     *
     * @return array<array-key, ProductSalesInformation>
     *
     * @throws Logic4ApiException
     */
    public function getProductCollectionSalesInformation(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => ProductSalesInformation::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Management/GetProductCollectionSalesInformation', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Omzet van een bepaalde periode (Facturen/open orders/abonnementen).
     *
     * @param array{
     *     TimeFrame?: mixed,
     *     IncludingCurrentPeriod?: bool,
     *     HistoryPoints?: int,
     *     IncludeOffers?: bool|null,
     *     IncludeOpenOrders?: bool|null,
     *     IncludeOrders?: bool|null,
     *     IncludeSubscriptions?: bool|null,
     *     IncludeInvoices?: bool|null,
     *     Year?: int|null,
     *     WebSiteDomainsIds?: array<int>,
     *     TypeContactGroupsIds?: array<int>,
     *     ExcludingDebtors?: array<int>,
     *     OnlyForExcludingDebtors?: bool,
     *     NotLinkedToWebsiteDomain?: bool,
     *     EmployeeIds?: array<int>,
     *     BranchIds?: array<int>,
     *     ProductGroupsIds?: array<int>,
     * } $parameters
     *
     * @return array<array-key, ValuevsBudget>
     *
     * @throws Logic4ApiException
     */
    public function getReportingGetSalesHistory(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => ValuevsBudget::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Management/GetReportingGetSalesHistory', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Omzet o.b.v. order/factuur regels voor een bepaalde periode.
     *
     * @param array{
     *     TimeFrame?: mixed,
     *     IncludingCurrentPeriod?: bool,
     *     HistoryPoints?: int,
     *     IncludeOffers?: bool|null,
     *     IncludeOpenOrders?: bool|null,
     *     IncludeOrders?: bool|null,
     *     IncludeSubscriptions?: bool|null,
     *     IncludeInvoices?: bool|null,
     *     Year?: int|null,
     *     WebSiteDomainsIds?: array<int>,
     *     TypeContactGroupsIds?: array<int>,
     *     ExcludingDebtors?: array<int>,
     *     OnlyForExcludingDebtors?: bool,
     *     NotLinkedToWebsiteDomain?: bool,
     *     EmployeeIds?: array<int>,
     *     BranchIds?: array<int>,
     *     ProductGroupsIds?: array<int>,
     * } $parameters
     *
     * @return array<array-key, ValuevsBudget>
     *
     * @throws Logic4ApiException
     */
    public function getReportingGetSalesHistoryForOrderRows(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => ValuevsBudget::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Management/GetReportingGetSalesHistoryForOrderRows', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Omzet van een bepaalde periode per type contact groep (Facturen/open orders/abonnementen).
     *
     * @param array{
     *     TimeFrame?: mixed,
     *     IncludingCurrentPeriod?: bool,
     *     HistoryPoints?: int,
     *     IncludeOffers?: bool|null,
     *     IncludeOpenOrders?: bool|null,
     *     IncludeOrders?: bool|null,
     *     IncludeSubscriptions?: bool|null,
     *     IncludeInvoices?: bool|null,
     *     Year?: int|null,
     *     WebSiteDomainsIds?: array<int>,
     *     TypeContactGroupsIds?: array<int>,
     *     ExcludingDebtors?: array<int>,
     *     OnlyForExcludingDebtors?: bool,
     *     NotLinkedToWebsiteDomain?: bool,
     *     EmployeeIds?: array<int>,
     *     BranchIds?: array<int>,
     *     ProductGroupsIds?: array<int>,
     * } $parameters
     *
     * @return array<array-key, ValuevsBudget>
     *
     * @throws Logic4ApiException
     */
    public function getReportingGetSalesHistoryForTypeContactGroups(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => ValuevsBudget::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Management/GetReportingGetSalesHistoryForTypeContactGroups', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Grootboek omzet en budgetten.
     *
     * @param array{
     *     LedgerCodes?: array<int>,
     *     GetOnlyMutationTotal?: bool,
     *     CreditCorrection?: bool,
     *     LedgerColumnTypeIds?: array<int>,
     *     TimeFrame?: mixed,
     *     IncludingCurrentPeriod?: bool,
     *     HistoryPoints?: int,
     *     IncludeOffers?: bool|null,
     *     IncludeOpenOrders?: bool|null,
     *     IncludeOrders?: bool|null,
     *     IncludeSubscriptions?: bool|null,
     *     IncludeInvoices?: bool|null,
     *     Year?: int|null,
     *     WebSiteDomainsIds?: array<int>,
     *     TypeContactGroupsIds?: array<int>,
     *     ExcludingDebtors?: array<int>,
     *     OnlyForExcludingDebtors?: bool,
     *     NotLinkedToWebsiteDomain?: bool,
     *     EmployeeIds?: array<int>,
     *     BranchIds?: array<int>,
     *     ProductGroupsIds?: array<int>,
     * } $parameters
     *
     * @return array<array-key, ValuevsBudget>
     *
     * @throws Logic4ApiException
     */
    public function getReportingLedgerHistoryAndBudget(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => ValuevsBudget::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Management/GetReportingLedgerHistoryAndBudget', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Omzet van huidige jaar o.b.v. facturen (Let op! er wordt geen rekening gehouden met de geschiedenispunten).
     *
     * @param array{
     *     TimeFrame?: mixed,
     *     IncludingCurrentPeriod?: bool,
     *     HistoryPoints?: int,
     *     IncludeOffers?: bool|null,
     *     IncludeOpenOrders?: bool|null,
     *     IncludeOrders?: bool|null,
     *     IncludeSubscriptions?: bool|null,
     *     IncludeInvoices?: bool|null,
     *     Year?: int|null,
     *     WebSiteDomainsIds?: array<int>,
     *     TypeContactGroupsIds?: array<int>,
     *     ExcludingDebtors?: array<int>,
     *     OnlyForExcludingDebtors?: bool,
     *     NotLinkedToWebsiteDomain?: bool,
     *     EmployeeIds?: array<int>,
     *     BranchIds?: array<int>,
     *     ProductGroupsIds?: array<int>,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getSalesTotalIncludingOrdersAndRepeating(array $parameters = []): float
    {
        return $this->buildResponse(
            $this->getClient()->post('/v3/Management/GetSalesTotalIncludingOrdersAndRepeating', ['json' => $parameters]),
        );
    }

    /**
     * Top 10 filialen (dag/week/maand/kwartaal/jaar).
     *
     * @param array{
     *     TimeFrame?: mixed,
     *     IncludingCurrentPeriod?: bool,
     *     ExcludeDebtorIds?: array<int>,
     *     WebSiteDomainsIds?: array<int>,
     * } $parameters
     *
     * @return array<array-key, Top10Item>
     *
     * @throws Logic4ApiException
     */
    public function getTop10Branches(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => Top10Item::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Management/GetTop10Branches', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Top 10 klanten (dag/week/maand/kwartaal/jaar).
     *
     * @param array{
     *     TimeFrame?: mixed,
     *     IncludingCurrentPeriod?: bool,
     *     ExcludeDebtorIds?: array<int>,
     *     WebSiteDomainsIds?: array<int>,
     * } $parameters
     *
     * @return array<array-key, Top10Item>
     *
     * @throws Logic4ApiException
     */
    public function getTop10Debtors(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => Top10Item::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Management/GetTop10Debtors', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Top 10 productgroepen (dag/week/maand/kwartaal/jaar).
     *
     * @param array{
     *     TimeFrame?: mixed,
     *     IncludingCurrentPeriod?: bool,
     *     ExcludeDebtorIds?: array<int>,
     *     WebSiteDomainsIds?: array<int>,
     * } $parameters
     *
     * @return array<array-key, Top10Item>
     *
     * @throws Logic4ApiException
     */
    public function getTop10Productgroups(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => Top10Item::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Management/GetTop10Productgroups', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Top 10 artikelen (dag/week/maand/kwartaal/jaar).
     *
     * @param array{
     *     TimeFrame?: mixed,
     *     IncludingCurrentPeriod?: bool,
     *     ExcludeDebtorIds?: array<int>,
     *     WebSiteDomainsIds?: array<int>,
     * } $parameters
     *
     * @return array<array-key, Top10Item>
     *
     * @throws Logic4ApiException
     */
    public function getTop10Products(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => Top10Item::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Management/GetTop10Products', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Top 10 provincies (dag/week/maand/kwartaal/jaar).
     *
     * @param array{
     *     TimeFrame?: mixed,
     *     IncludingCurrentPeriod?: bool,
     *     ExcludeDebtorIds?: array<int>,
     *     WebSiteDomainsIds?: array<int>,
     * } $parameters
     *
     * @return array<array-key, Top10Item>
     *
     * @throws Logic4ApiException
     */
    public function getTop10Provinces(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => Top10Item::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Management/GetTop10Provinces', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Top 10 medewerkers (dag/week/maand/kwartaal/jaar).
     *
     * @param array{
     *     TimeFrame?: mixed,
     *     IncludingCurrentPeriod?: bool,
     *     ExcludeDebtorIds?: array<int>,
     *     WebSiteDomainsIds?: array<int>,
     * } $parameters
     *
     * @return array<array-key, Top10Item>
     *
     * @throws Logic4ApiException
     */
    public function getTop10Users(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => Top10Item::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Management/GetTop10Users', ['json' => $parameters]),
            ),
        );
    }
}
