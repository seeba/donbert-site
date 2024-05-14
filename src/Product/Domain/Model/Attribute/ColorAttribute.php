<?php

declare(strict_types=1);

namespace App\Product\Domain\Model\Attribute;

final class ColorAttribute extends Attribute
{
    private function __construct(
        private AttributeId $id,
        private string $name,
        private string $color   
    ) {  
        parent::__construct($id, $name);
    }

    public static function create(
        AttributeId $id,
        string $name,
        string $color
    
    ): self {

        $attribute = new self($id, $name, $color);
        return $attribute;
    }

    public static function restore(
        AttributeId $id,
        string $name,
        string $color  
    ): self {

        $attribute = new self($id, $name, $color);
        return $attribute;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getColor(): string
    {
        return $this->color;
    }
}