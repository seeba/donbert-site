<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

class Quantity
{
    public function __construct(
        private int $quantity, 
    ){    
    }

    public function toString(): string 
    {
        return (string)$this->quantity;
    }

    public function getValue(): int
    {
        return $this->quantity;
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}