<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\Entity\Attribute;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
class SizeAttribute extends Attribute
{
    #[ORM\Column(type:Types::STRING, length:255)]
    private string $size;

    public function __construct(
        string $id,
        string $name,
        string $size,
    )
    {
        parent::__construct($id, $name);
        $this->size = $size;
    }
}