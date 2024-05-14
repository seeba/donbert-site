<?php

declare(strict_types=1);

namespace App\Product\Domain\Model\Attribute;

final class SizeAttribute extends Attribute
{
    private function __construct(
        private AttributeId $id,
        private string $name,
        private int $width,
        private int $height   
    ) {  
        parent::__construct($id, $name);
    }

    public static function create(
        AttributeId $id,
        string $name,
        int $width,
        int $height
    
    ): self {

        $attribute = new self($id, $name, $width, $height);
        return $attribute;
    }

    public static function restore(
        AttributeId $id,
        string $name,
        int $width,
        int $height 
    ): self {

        $attribute = new self($id, $name, $width, $height);
        return $attribute;
    }

    public function getName(): string
    {
        return $this->name;
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