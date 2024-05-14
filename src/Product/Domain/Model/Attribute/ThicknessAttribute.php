<?php

declare(strict_types=1);

namespace App\Product\Domain\Model\Attribute;

final class ThicknessAttribute extends Attribute
{
    private function __construct(
        private AttributeId $id,
        private string $name,
        private float $thickness   
    ) {  
        parent::__construct($id, $name);
    }

    public static function create(
        AttributeId $id,
        string $name,
        float $thickness
    
    ): self {

        $attribute = new self($id, $name, $thickness);
        return $attribute;
    }

    public static function restore(
        AttributeId $id,
        string $name,
        float $thickness  
    ): self {

        $attribute = new self($id, $name, $thickness);
        return $attribute;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getThickness(): float
    {
        return $this->thickness;
    }
}