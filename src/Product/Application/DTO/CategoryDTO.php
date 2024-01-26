<?php

declare(strict_types=1);

namespace App\Product\Application\DTO;

class CategoryDTO 
{
    public function __construct(
        public ?string $name = null,
        public ?string $parentId = null
    )
    {
    }   
}