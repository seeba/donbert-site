<?php

declare(strict_types=1);

namespace App\Product\Application\DTO;

class VariantAttributesDTO 
{
    public function __construct(
        public ?string $size = null,
        public ?string $color = null,
        public ?string $thickness = null,
        public ?string $quantityPerRoll = null
    )
    {
    }
    
}