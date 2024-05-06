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

    #[ORM\OneToMany(targetEntity:"App\Product\Infrastructure\Entity\Image", mappedBy:"variant", cascade:["persist", "remove"])]
    private Collection $images;

    public function __construct(
        string $id,
        string $name,
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->attributes = new ArrayCollection();
        $this->images = new ArrayCollection();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getId(): string
    {
        return $this->id;
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

    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains(($image))) {
            $this->images->add($image);
            $image->setVariant($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        $this->images->removeElement($image);

        return $this;
    }

    public function getAtrributes(): ArrayCollection
    {
        return $this->attributes;
    }

    public function addAttribute(Attribute $attribute ): self
    {
        if (!$this->attributes->contains($attribute)) {
            $this->attributes->add($attribute);
        }

        return $this;
    }

    public function removeAttribute(Attribute $attribute): self
    {
        $this->attributes->removeElement($attribute);

        return $this;
    }

}