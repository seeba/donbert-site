<?php

declare(strict_types=1);

namespace App\Product\Application\DTO;

readonly class CategoryDTO 
{
    public function __construct(
        public ?string $name = null,
        public ?string $parentId = null
    )
    {
    }   
}