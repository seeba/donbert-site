<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

class Size
{
    public function __construct(
        private int $width, 
        private int $height
    ) {    
    }

    public function toArray(): array 
    {
        return [
            'width' => $this->width,
            'height' => $this->height
        ];
    }

    public function toString(): string 
    {
        return $this->width.'x'.$this->height;
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
}