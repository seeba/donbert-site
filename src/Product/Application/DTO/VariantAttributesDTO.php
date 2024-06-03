<?php

declare(strict_types=1);

namespace App\Product\Application\DTO;

class VariantAttributesDTO 
{
    public function __construct(
        public ?array $size = null,
        public ?array $color = null,
        public ?array $thickness = null,
        public ?array $quantityPerRoll = null
    )
    {
    }
    
}