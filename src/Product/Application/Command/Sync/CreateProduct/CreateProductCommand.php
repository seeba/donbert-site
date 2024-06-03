<?php

declare(strict_types=1);

namespace App\Product\Application\Command\Sync\CreateProduct;

use App\Shared\Application\Command\Sync\CommandInterface;

readonly class CreateProductCommand implements CommandInterface
{
    public function __construct(
        public string $id,
        public string $name,
        public array $categoriesIds,
        public array $size,
    )
    {
        
    }
}