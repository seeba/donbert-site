<?php

declare(strict_types=1);

namespace App\Product\Domain\Model;

use App\Shared\Domain\Aggregate\AggregateRoot;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

final class Variant
{
    
    private function __construct(
        private VariantId $id,
        private string $name,
        private array $images = []
       
    )
    {}

    public static function create(
        VariantId $id,
        string $name,
    
    ): self {

        $variant = new self($id, $name);
        return $variant;
    }

    public static function restore(
        VariantId $id,
        string $name,
       
    ): self {

        $variant = new self($id, $name);
        return $variant;
    }

    public function getId(): VariantId
    {
        return $this->id;
    }


    public function getName(): string
    {
        return $this->name;
    }

    public function getImages() : array
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!in_array($image, $this->images, true)) {
            $this->images[] = $image;
        }

        return $this;
    }
}