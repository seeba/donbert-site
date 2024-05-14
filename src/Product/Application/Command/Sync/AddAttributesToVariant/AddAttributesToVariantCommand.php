<?php

declare(strict_types=1);

namespace App\Product\Application\Command\Sync\AddAttributesToVariant;

use App\Shared\Application\Command\Sync\CommandInterface;

readonly class AddAttributesToVariantCommand implements CommandInterface
{
    public function __construct(
       public string $variantId,
       public array $attributes
    ) {
    }
    
}