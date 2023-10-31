<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

class ProductGroup
{
    public function __construct(
        public int $id,
        public ?string $name,
        public ?int $parentProductGroupId,
        public ?string $shortname,
        public ?string $pictureUrl,
        public int $sortValue,
        public ?string $pictureName,
        public int $productGroupTypeId,
        public bool $isVisibleOnWebshop,
        public int $depthLevel,
        public bool $showUnitOnWebsite,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            id: $data['Id'],
            name: $data['Name'],
            parentProductGroupId: $data['ParentProductGroupId'],
            shortname: $data['Shortname'],
            pictureUrl: $data['PictureUrl'],
            sortValue: $data['SortValue'],
            pictureName: $data['PictureName'],
            productGroupTypeId: $data['ProductGroupTypeId'],
            isVisibleOnWebshop: $data['IsVisibleOnWebshop'],
            depthLevel: $data['DepthLevel'],
            showUnitOnWebsite: $data['ShowUnitOnWebsite'],
        );
    }
}
