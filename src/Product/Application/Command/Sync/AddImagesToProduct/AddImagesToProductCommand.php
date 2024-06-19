<?php

declare(strict_types=1);

namespace App\Product\Application\Command\Sync\AddImagesToProduct;

use App\Shared\Application\Command\Sync\CommandInterface;

final readonly class AddImagesToProductCommand implements CommandInterface
{
    public function __construct(
       public string $productId,
       public array $images
    ) {
    }
    
    public function getProductId(): string
    {
        return $this->productId;
    }

    public function getImages(): array
    {
        return $this->images;
    }
}