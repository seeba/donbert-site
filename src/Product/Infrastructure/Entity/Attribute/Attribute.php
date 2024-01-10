<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\Entity\Attribute;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
#[ORM\Table(name:"attributes")]
#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name:"attribute_type")]
#[ORM\DiscriminatorMap([
    "base" => "Attribute", 
    "color" => "ColorAttribute", 
    'size' => "SizeAttribute"
    ])]
class Attribute
{
    #[ORM\Id]
    #[ORM\Column(type:Types::GUID)]
    private string $id;

    #[ORM\Column(type:Types::STRING, length:255)]
    private string $name;

    public function __construct(
        string $id,
        string $name,
    )
    {
        $this->id = $id;
        $this->name = $name;
    }
}