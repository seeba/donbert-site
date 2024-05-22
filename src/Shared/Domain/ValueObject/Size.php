<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

class Size
{
    public function __construct(
        private int $width, 
        private int $height,
        private int $literCapacity
    ) {    
    }

    public function toArray(): array 
    {
        return [
            'width' => $this->width,
            'height' => $this->height,
            'liter_capacity' => $this->literCapacity
        ];
    }

    public function toString(): string 
    {
        return $this->width.'x'.$this->height.' '.$this->literCapacity.' l';
    }

    public function __toString(): string
    {
        return $this->toString();
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function getLiterCapacity(): int
    {
        return $this->literCapacity;
    }
}