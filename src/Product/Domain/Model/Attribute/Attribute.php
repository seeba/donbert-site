<?php

declare(strict_types=1);

namespace App\Product\Domain\Model\Attribute;

class Attribute
{
    protected function __construct(
        private AttributeId $id,
        private string $name,   
    ) {  
    }

    public function getId(): AttributeId
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}