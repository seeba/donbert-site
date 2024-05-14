<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\Entity\Attribute;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
class QuantityPerRollAttribute extends Attribute
{
    #[ORM\Column(type:Types::INTEGER, length:255)]
    private int $quantity;

    public function __construct(
        string $id,
        string $name,
        int $quantity,
    )
    {
        parent::__construct($id, $name);
        $this->quantity = $quantity;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }
}