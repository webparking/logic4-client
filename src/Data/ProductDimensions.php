<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

class ProductDimensions
{
    public function __construct(
        public int $productId,
        public ?string $productCode,
        public ?int $piecesOnPallet,
        public ?int $PCSinInsidePackage,
        public ?int $PCSinOutsidePackage,
        public float $weightSingleProduct,
        public float $weightInsidePackage,
        public float $weightOutsidePackage,
        public float $volumeSingleProduct,
        public float $volumeInsidePackage,
        public float $volumeOutsidePackage,
        public float $widthSingleProduct,
        public float $widthInsidePackage,
        public float $widthOutsidePackage,
        public float $heightSingleProduct,
        public float $heightInsidePackage,
        public float $heightOutsidePackage,
        public float $depthSingleProduct,
        public float $depthInsidePackage,
        public float $depthOutsidePackage,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            productId: $data['ProductId'],
            productCode: $data['ProductCode'],
            piecesOnPallet: $data['PiecesOnPallet'],
            PCSinInsidePackage: $data['PCSinInsidePackage'],
            PCSinOutsidePackage: $data['PCSinOutsidePackage'],
            weightSingleProduct: $data['WeightSingleProduct'],
            weightInsidePackage: $data['WeightInsidePackage'],
            weightOutsidePackage: $data['WeightOutsidePackage'],
            volumeSingleProduct: $data['VolumeSingleProduct'],
            volumeInsidePackage: $data['VolumeInsidePackage'],
            volumeOutsidePackage: $data['VolumeOutsidePackage'],
            widthSingleProduct: $data['WidthSingleProduct'],
            widthInsidePackage: $data['WidthInsidePackage'],
            widthOutsidePackage: $data['WidthOutsidePackage'],
            heightSingleProduct: $data['HeightSingleProduct'],
            heightInsidePackage: $data['HeightInsidePackage'],
            heightOutsidePackage: $data['HeightOutsidePackage'],
            depthSingleProduct: $data['DepthSingleProduct'],
            depthInsidePackage: $data['DepthInsidePackage'],
            depthOutsidePackage: $data['DepthOutsidePackage'],
        );
    }
}
