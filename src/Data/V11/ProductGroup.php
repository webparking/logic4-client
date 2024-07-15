<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V11;

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
            id: $data['Id'] ?? 0,
            name: $data['Name'] ?? null,
            parentProductGroupId: $data['ParentProductGroupId'] ?? null,
            shortname: $data['Shortname'] ?? null,
            pictureUrl: $data['PictureUrl'] ?? null,
            sortValue: $data['SortValue'] ?? 0,
            pictureName: $data['PictureName'] ?? null,
            productGroupTypeId: $data['ProductGroupTypeId'] ?? 0,
            isVisibleOnWebshop: $data['IsVisibleOnWebshop'] ?? false,
            depthLevel: $data['DepthLevel'] ?? 0,
            showUnitOnWebsite: $data['ShowUnitOnWebsite'] ?? false,
        );
    }
}
