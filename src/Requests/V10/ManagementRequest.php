<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V10;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V10\DecimalLogic4Response;
use Webparking\Logic4Client\Responses\V10\ProductSalesInformationLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\Top10ItemLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\ValuevsBudgetLogic4ResponseList;

class ManagementRequest extends Request
{
    /**
     * Verkrijg van één of meerdere artikelen verkoop gegevens zoals verkoopaantallen, over een bepaalde periode (dag/week/maand/kwartaal/jaar).
     *
     * @param array{
     *     TimeFrame?: string,
     *     HistoryPoints?: int,
     *     ProductCodes?: array<string>,
     *     IncludingCurrentPeriod?: bool,
     *     ExcludeDebtorIds?: array<int>,
     *     WebSiteDomainsIds?: array<int>,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getProductCollectionSalesInformation(
        array $parameters = [],
    ): ProductSalesInformationLogic4ResponseList {
        return ProductSalesInformationLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Management/GetProductCollectionSalesInformation', ['json' => $parameters]),
            )
        );
    }

    /**
     * Omzet van een bepaalde periode (Facturen/open orders/abonnementen).
     *
     * @param array{
     *     TimeFrame?: string,
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
    public function getReportingGetSalesHistory(
        array $parameters = [],
    ): ValuevsBudgetLogic4ResponseList {
        return ValuevsBudgetLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Management/GetReportingGetSalesHistory', ['json' => $parameters]),
            )
        );
    }

    /**
     * Omzet o.b.v. order/factuur regels voor een bepaalde periode.
     *
     * @param array{
     *     TimeFrame?: string,
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
    public function getReportingGetSalesHistoryForOrderRows(
        array $parameters = [],
    ): ValuevsBudgetLogic4ResponseList {
        return ValuevsBudgetLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Management/GetReportingGetSalesHistoryForOrderRows', ['json' => $parameters]),
            )
        );
    }

    /**
     * Omzet van een bepaalde periode per type contact groep (Facturen/open orders/abonnementen).
     *
     * @param array{
     *     TimeFrame?: string,
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
    public function getReportingGetSalesHistoryForTypeContactGroups(
        array $parameters = [],
    ): ValuevsBudgetLogic4ResponseList {
        return ValuevsBudgetLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Management/GetReportingGetSalesHistoryForTypeContactGroups', ['json' => $parameters]),
            )
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
     *     TimeFrame?: string,
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
    public function getReportingLedgerHistoryAndBudget(
        array $parameters = [],
    ): ValuevsBudgetLogic4ResponseList {
        return ValuevsBudgetLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Management/GetReportingLedgerHistoryAndBudget', ['json' => $parameters]),
            )
        );
    }

    /**
     * Omzet van huidige jaar o.b.v. facturen (Let op! er wordt geen rekening gehouden met de geschiedenispunten).
     *
     * @param array{
     *     TimeFrame?: string,
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
    public function getSalesTotalIncludingOrdersAndRepeating(
        array $parameters = [],
    ): DecimalLogic4Response {
        return DecimalLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Management/GetSalesTotalIncludingOrdersAndRepeating', ['json' => $parameters]),
            )
        );
    }

    /**
     * Top 10 filialen (dag/week/maand/kwartaal/jaar).
     *
     * @param array{
     *     TimeFrame?: string,
     *     IncludingCurrentPeriod?: bool,
     *     ExcludeDebtorIds?: array<int>,
     *     WebSiteDomainsIds?: array<int>,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getTop10Branches(
        array $parameters = [],
    ): Top10ItemLogic4ResponseList {
        return Top10ItemLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Management/GetTop10Branches', ['json' => $parameters]),
            )
        );
    }

    /**
     * Top 10 klanten (dag/week/maand/kwartaal/jaar).
     *
     * @param array{
     *     TimeFrame?: string,
     *     IncludingCurrentPeriod?: bool,
     *     ExcludeDebtorIds?: array<int>,
     *     WebSiteDomainsIds?: array<int>,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getTop10Debtors(
        array $parameters = [],
    ): Top10ItemLogic4ResponseList {
        return Top10ItemLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Management/GetTop10Debtors', ['json' => $parameters]),
            )
        );
    }

    /**
     * Top 10 productgroepen (dag/week/maand/kwartaal/jaar).
     *
     * @param array{
     *     TimeFrame?: string,
     *     IncludingCurrentPeriod?: bool,
     *     ExcludeDebtorIds?: array<int>,
     *     WebSiteDomainsIds?: array<int>,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getTop10Productgroups(
        array $parameters = [],
    ): Top10ItemLogic4ResponseList {
        return Top10ItemLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Management/GetTop10Productgroups', ['json' => $parameters]),
            )
        );
    }

    /**
     * Top 10 artikelen (dag/week/maand/kwartaal/jaar).
     *
     * @param array{
     *     TimeFrame?: string,
     *     IncludingCurrentPeriod?: bool,
     *     ExcludeDebtorIds?: array<int>,
     *     WebSiteDomainsIds?: array<int>,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getTop10Products(
        array $parameters = [],
    ): Top10ItemLogic4ResponseList {
        return Top10ItemLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Management/GetTop10Products', ['json' => $parameters]),
            )
        );
    }

    /**
     * Top 10 provincies (dag/week/maand/kwartaal/jaar).
     *
     * @param array{
     *     TimeFrame?: string,
     *     IncludingCurrentPeriod?: bool,
     *     ExcludeDebtorIds?: array<int>,
     *     WebSiteDomainsIds?: array<int>,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getTop10Provinces(
        array $parameters = [],
    ): Top10ItemLogic4ResponseList {
        return Top10ItemLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Management/GetTop10Provinces', ['json' => $parameters]),
            )
        );
    }

    /**
     * Top 10 medewerkers (dag/week/maand/kwartaal/jaar).
     *
     * @param array{
     *     TimeFrame?: string,
     *     IncludingCurrentPeriod?: bool,
     *     ExcludeDebtorIds?: array<int>,
     *     WebSiteDomainsIds?: array<int>,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getTop10Users(
        array $parameters = [],
    ): Top10ItemLogic4ResponseList {
        return Top10ItemLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Management/GetTop10Users', ['json' => $parameters]),
            )
        );
    }
}
