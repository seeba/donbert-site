<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\Entity\Attribute;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
class ThicknessAttribute extends Attribute
{
    #[ORM\Column(type:Types::FLOAT, length:255)]
    private float $thickness;

    public function __construct(
        string $id,
        string $name,
        float $thickness,
    )
    {
        parent::__construct($id, $name);
        $this->thickness = $thickness;
    }

    public function getThickness(): float
    {
        return $this->thickness;
    }
}