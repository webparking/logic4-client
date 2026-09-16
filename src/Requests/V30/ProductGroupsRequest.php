<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V30;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V30\ProductGroup;
use Webparking\Logic4Client\Responses\V30\ProductGroupType;

class ProductGroupsRequest extends Request
{
    /**
     * Verkrijg artikelgroepen o.b.v. het meegestuurde filter.
     *
     * @param array{
     *     SkipRecords?: int,
     *     TakeRecords?: int,
     *     IsTopLevelGroup?: bool|null,
     *     Name?: string|null,
     *     IsVisibleOnWebShop?: bool|null,
     *     ParentId?: int|null,
     *     HasProductsVisibleOnWebshop?: bool|null,
     *     ProductGroupTypeId?: int|null,
     *     WebsiteDomainId?: int|null,
     *     GlobalisationId?: int|null,
     * } $parameters
     *
     * @return array<array-key, ProductGroup>
     *
     * @throws Logic4ApiException
     */
    public function getProductGroups(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => ProductGroup::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/ProductGroups/GetProductGroups', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Verkrijg alle artikelgroep types.
     *
     * @return array<array-key, ProductGroupType>
     *
     * @throws Logic4ApiException
     */
    public function getProductGroupTypes(): array
    {
        return array_map(
            static fn (array $data) => ProductGroupType::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/ProductGroups/GetProductGroupTypes'),
            ),
        );
    }

    /**
     * Wijzig artikelgroep SEO informatie.
     * Een SEO informatie record word op basis van een combinatie van ProductGroupId, GlobalizationId en WebsiteDomainId geselecteerd.
     * WebsiteDomainId mag null zijn, dan geldt de gegeven SEO informatie voor alle webhopdomeinen.
     * <br />
     * Als een record niet bestaat wordt deze aangemaakt.Lege records worden automatisch verwijdert.
     * Niet-lege records moeten ten minste een Title of Description hebben.
     * <br />
     * Bij het meegeven van een lege string of 'null' voor informatie velden, wordt bestaande informatie leeg gehaald.
     * Velden die niet in de request staan worden niet gewijzigd.
     * <br />
     * Als een product geen SEO informatie heeft voor een bepaalde taal en webshopdomein
     * vindt er een fallback plaats op de basis informatie van de artikelgroep.
     *
     * @param array{
     *     Product_GroupId?: int,
     *     GlobalisationId?: int,
     *     WebsiteDomainId?: int|null,
     *     H1Tag?: string|null,
     *     Keywords?: string|null,
     *     Name?: string|null,
     *     ProductGroupInfo?: string|null,
     *     Value?: string|null,
     *     MetaDescription?: string|null,
     *     ShortName?: string|null,
     *     USPDescription?: string|null,
     *     GlobalisationCode?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function updateProductGroupSEOInformation(array $parameters = []): void
    {
        $this->getClient()->patch('/v3/ProductGroups/UpdateProductGroupSEOInformation', ['json' => $parameters]);
    }
}
