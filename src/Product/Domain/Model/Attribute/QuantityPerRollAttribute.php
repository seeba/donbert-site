<?php

declare(strict_types=1);

namespace App\Product\Domain\Model\Attribute;

final class QuantityPerRollAttribute extends Attribute
{
    private function __construct(
        private AttributeId $id,
        private string $name,
        private int $quantity   
    ) {  
        parent::__construct($id, $name);
    }

    public static function create(
        AttributeId $id,
        string $name,
        int $quantity
    
    ): self {

        $attribute = new self($id, $name, $quantity);
        return $attribute;
    }

    public static function restore(
        AttributeId $id,
        string $name,
        int $quantity 
    ): self {

        $attribute = new self($id, $name, $quantity);
        return $attribute;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }
}