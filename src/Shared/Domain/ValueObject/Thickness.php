<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

class Thickness
{
    public function __construct(
        private float $thickness 
    ){    
    }

    public function toString(): string 
    {
        return (string) $this->thickness;
    }

    public function getValue(): float
    {
        return $this->thickness;
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}