<?php

declare(strict_types=1);


namespace GeNyaa\ShopwareApiSdk\Dto;

use Carbon\Carbon;

class Product
{
    public function __construct(
        public string $id,
        public string $name,
        public ?string $versionId,
        public ?string $parentId,
        public ?string $manufacturerId,
        public ?string $productManufacturerVersionId,
        public ?string $unitId,
        public ?string $taxId,
        public ?string $coverId,
        public ?string $productMediaVersionId,
        public ?string $deliveryTimeId,
        public array $price,
        public ?string $productNumber,
        public int $stock,
        public int $restockTime,
        public int $autoIncrement,
        public bool $active,
        public int $availableStock,
        public bool $available,
        public bool $isCloseout,
        public string $displayGroup,
        public array $configuratorGroupConfig,
        public ?string $mainVariantId,
        public array $variantRestrictions,
        public ?string $manufacturerNumber,
        public ?string $ean,
        public int $purchaseSteps,
        public int $maxPurchase,
        public int $minPurchase,
        public float $purchaseUnit,
        public float $referenceUnit,
        public bool $shippingFree,
        public float $purchasePrice,
        public bool $markAsTopseller,
        public float $weight,
        public float $width,
        public float $height,
        public float $length,
        public Carbon $releaseDate,
        public float $ratingAverage,
        public array $categoryTree,
        public array $propertyIds,
        public array $optionIds,
        public array $tagIds,
        public array $listingPrices,
        public int $childCount,
        public array $blacklistIds,
        public array $whitelistIds,
        public bool $customFieldSetSelectionActive,
        public int $sales,
        public string $metaDescription,
        public string $name,
        public string $keywords,
        public string $description,
        public string $metaTitle,
        public string $packUnit,
        public string $packUnitPlural,
        public array $customFields,
        public Carbon $createdAt,
        public Carbon $updatedAt,
    )
    {
    }
}