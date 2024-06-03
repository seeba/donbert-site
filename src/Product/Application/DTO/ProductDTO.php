<?php

declare(strict_types=1);

namespace App\Product\Application\DTO;

class ProductDTO 
{
    public function __construct(
        public ?string $name = null,
        public ?array $categoriesIds = null,
        public ?array $size = null
    )
    {
    }   
}