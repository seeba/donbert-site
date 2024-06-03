<?php

declare(strict_types=1);

namespace App\Product\Application\Command\Sync\AddImagesToVariant;

use App\Shared\Application\Command\Sync\CommandInterface;

final readonly class AddImagesToVariantCommand implements CommandInterface
{
    public function __construct(
       public string $variantId,
       public array $images
    )
    {
    }
    
    public function getVariantId(): string
    {
        return $this->variantId;
    }

    public function getImages(): array
    {
        return $this->images;
    }
}