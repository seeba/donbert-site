<?php

declare(strict_types=1);

namespace App\Product\Application\Command\Sync\CreateVariant;

use App\Shared\Application\Command\Sync\CommandInterface;

final readonly class CreateVariantCommand implements CommandInterface
{
    public function __construct(
        public string $id,
        public string $name,
        public string $productId
    ) {  
    }
}