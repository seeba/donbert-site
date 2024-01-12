<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\Entity;

use App\Product\Infrastructure\Entity\Attribute\Attribute;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
#[ORM\Table(name:"variants")]
class Variant
{
    #[ORM\Id]
    #[ORM\Column(type:Types::GUID)]
    private string $id;

    #[ORM\Column(type:Types::STRING, length:255)]
    private string $name;

    #[ORM\ManyToOne(targetEntity:"App\Product\Infrastructure\Entity\Product", inversedBy:"variants")]
    #[ORM\JoinColumn(nullable:false)]
    private $product;

    #[ORM\ManyToMany(targetEntity:"App\Product\Infrastructure\Entity\Attribute\Attribute")]
    #[ORM\JoinTable(name:"variant_attributes")]
    #[ORM\JoinColumn(name:"variant_id", referencedColumnName:"id")]
    #[ORM\InverseJoinColumn(name:"attributte_id", referencedColumnName:"id")]
    private $attributes;

    public function __construct(
        string $id,
        string $name,
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->attributes = new ArrayCollection();
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getAtrributes(): Collection
    {
        return $this->attributes;
    }

    public function addAttribute(Attribute $attribute ): self
    {
        if (!$this->attributes->contains($attribute)) {
            $this->attributes[] = $attribute;
        }

        return $this;
    }

    public function removeAttribute(Attribute $attribute): self
    {
        $this->attributes->removeElement($attribute);

        return $this;
    }
}