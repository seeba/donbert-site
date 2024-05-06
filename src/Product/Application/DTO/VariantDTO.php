<?php

declare(strict_types=1);

namespace App\Product\Application\DTO;

class VariantDTO 
{
    public function __construct(
        public ?string $productId = null,
        public ?string $name = null,
        public ?array $images = null
    )
    {
    }
    
}