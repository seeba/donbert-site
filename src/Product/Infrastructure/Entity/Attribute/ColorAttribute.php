<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\Entity\Attribute;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
class ColorAttribute extends Attribute
{
    #[ORM\Column(type:Types::STRING, length:255)]
    private string $color;

    public function __construct(
        string $id,
        string $name,
        string $color,
    )
    {
        parent::__construct($id, $name);
        $this->color = $color;
    }
}