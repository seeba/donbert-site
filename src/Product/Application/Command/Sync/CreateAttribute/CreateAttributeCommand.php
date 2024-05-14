<?php

declare(strict_types=1);

namespace App\Product\Application\Command\Sync\CreateAttribute;

use App\Product\Application\Command\Sync\CreateAttribute\DTO\CreateAttributeDTO;
use App\Shared\Application\Command\Sync\CommandInterface;

readonly class CreateAttributeCommand implements CommandInterface
{
    public function __construct(
        public string $id,
        public CreateAttributeDTO $createAttributeDTO
    ) {
    }
}