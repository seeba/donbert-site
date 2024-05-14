<?php

declare(strict_types=1);

namespace App\Product\Application\Command\Sync\CreateAttribute\DTO;

use App\Product\Domain\ValueObject\AttributeType;
use App\Shared\Domain\ValueObject\Color;
use App\Shared\Domain\ValueObject\Quantity;
use App\Shared\Domain\ValueObject\Size;
use App\Shared\Domain\ValueObject\Thickness;

readonly class CreateAttributeDTO
{
    public function __construct(
        public string $name,
        public AttributeType $type,
        public ?Color $color = null,
        public ?Size $size = null,
        public ?Thickness $thickness = null,
        public ?Quantity $quantityPerRoll = null
    ) {  
    }
}