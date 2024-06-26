<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity()]
#[ORM\Table(name:"categories")]
class Category
{
    #[ORM\Id]
    #[ORM\Column(type:Types::GUID)]
    private string $id;

    #[ORM\Column(type:Types::STRING, length:255)]
    private string $name;

    #[ORM\Column(length:255, unique:true)]
    #[Gedmo\Slug(fields:['name'])]
    private string $slug;

    #[ORM\ManyToOne(targetEntity:"App\Product\Infrastructure\Entity\Category", inversedBy:"children")]
    #[ORM\JoinColumn(name:"parent_id", referencedColumnName:"id", onDelete:"SET NULL")]
    private $parent;

    #[ORM\OneToMany(targetEntity:"App\Product\Infrastructure\Entity\Category", mappedBy:"parent")]
    private Collection $children;

    #[ORM\ManyToMany(targetEntity:"App\Product\Infrastructure\Entity\Product", mappedBy:"categories")]
    private Collection $products;

    public function __construct(
        string $id,
        string $name,
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->children = new ArrayCollection();
        $this->products = new ArrayCollection();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getParent(): ?Category
    {
        return $this->parent;
    }

    public function setParent(Category $category): self
    {
        $this->parent = $category;

        return $this;
    }

    public function getChildren(): Collection
    {
        return $this->children;
    }

    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products->add($product);
            $product->addCategory($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            $product->removeCategory($this);
        }

        return $this;
    }
}