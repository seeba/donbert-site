<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\Entity\Attribute;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
class SizeAttribute extends Attribute
{
    #[ORM\Column(type:Types::INTEGER)]
    private int $width;

    #[ORM\Column(type:Types::INTEGER)]
    private int $height;

    #[ORM\Column(type:Types::INTEGER)]
    private int $literCapacity;

    public function __construct(
        string $id,
        string $name,
        int $width,
        int $height,
        int $literCapacity
    )
    {
        parent::__construct($id, $name);
        $this->height = $height;
        $this->width = $width;
        $this->literCapacity = $literCapacity;
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