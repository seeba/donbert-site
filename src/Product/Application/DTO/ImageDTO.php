<?php

declare(strict_types=1);

namespace App\Product\Application\DTO;

class ImageDTO 
{
    public function __construct(
        public ?string $productId = null,
        public ?string $name = null,
        public ?array $images = null,
        public ?VariantAttributesDTO $attributes = null,
    )
    {
    }
    
}