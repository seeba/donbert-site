<?php

declare(strict_types=1);

namespace App\Product\Application\Command\Sync;

use App\Shared\Application\Command\Sync\CommandInterface;

final readonly class CreateProductCommand implements CommandInterface
{
    public function __construct(
        public string $id,
        public string $name,
        public array $categoriesIds
    )
    {
        
    }
}