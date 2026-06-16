<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V30;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V30\BundleDiscount;
use Webparking\Logic4Client\Responses\V30\BundleGroupForChild;
use Webparking\Logic4Client\Responses\V30\BundleGroupsForParent;

class BundlesRequest extends Request
{
    /**
     * Verkijg de kortingen per hoeveelheid producten in een bundel.
     *
     * @return array<array-key, BundleDiscount>
     *
     * @throws Logic4ApiException
     */
    public function getBundleDiscounts(): array
    {
        return array_map(
            static fn (array $data) => BundleDiscount::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/Bundles/GetBundleDiscounts'),
            ),
        );
    }

    /**
     * Het is verplicht gebruik te maken van ParentProductIds en/of TakeRecords in het filter.
     *
     * @param array{
     *     ParentProductIds?: array<int>,
     *     SkipRecords?: int,
     *     TakeRecords?: int,
     * } $parameters
     *
     * @return array<array-key, BundleGroupsForParent>
     *
     * @throws Logic4ApiException
     */
    public function getBundles(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => BundleGroupsForParent::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Bundles/GetBundles', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Verkrijg bundles waarvan een product een kind is.
     *
     * @param array{
     *     ChildProductId?: int,
     *     SkipRecords?: int,
     *     TakeRecords?: int,
     * } $parameters
     *
     * @return array<array-key, BundleGroupForChild>
     *
     * @throws Logic4ApiException
     */
    public function getBundlesForChild(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => BundleGroupForChild::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Bundles/GetBundlesForChild', ['json' => $parameters]),
            ),
        );
    }
}
