<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

class Color
{
    public function __construct(
        private string $color, 
    ){    
    }

    public function toString(): string 
    {
        return $this->color;
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}