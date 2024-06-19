<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\Entity;

use App\Product\Infrastructure\Entity\Attribute\Attribute;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
#[ORM\Table(name:"products")]
class Product
{
    #[ORM\Id]
    #[ORM\Column(type:Types::GUID)]
    private string $id;

    #[ORM\Column(type:Types::STRING, length:255)]
    private string $name;

    #[ORM\OneToMany(targetEntity:"App\Product\Infrastructure\Entity\Variant", mappedBy:"product", cascade:["persist", "remove"])]
    private $variants;

    #[ORM\ManyToMany(targetEntity:"App\Product\Infrastructure\Entity\Attribute\Attribute")]
    #[ORM\JoinTable(name:"product_attributes")]
    #[ORM\JoinColumn(name:"product_id", referencedColumnName:"id")]
    #[ORM\InverseJoinColumn(name:"attributte_id", referencedColumnName:"id")]
    private $attributes;

    #[ORM\ManyToMany(targetEntity:"App\Product\Infrastructure\Entity\Category")]
    #[ORM\JoinTable(name:"product_category")]
    #[ORM\JoinColumn(name:"product_id", referencedColumnName:"id")]
    #[ORM\InverseJoinColumn(name:"category_id", referencedColumnName:"id")]
    private $categories;

    #[ORM\OneToMany(targetEntity:"App\Product\Infrastructure\Entity\Image", mappedBy:"variant", cascade:["persist", "remove"])]
    private Collection $images;

    public function __construct(
        string $id,
        string $name,
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->variants = new ArrayCollection();
        $this->categories = new ArrayCollection();
        $this->attributes = new ArrayCollection();
        $this->images = new ArrayCollection();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
    
    public function getVariants():Collection
    {
        return $this->variants;
    }

    public function addVariant(Variant $variant): self
    {
        if (!$this->variants->contains($variant)) {
            $this->variants->add($variant);
            $variant->setProduct($this);
        }

        return $this;
    }

    public function removeVariant(Variant $variant): self
    {
        if ($this->variants->removeElement($variant)) {
            // set the owning side to null (unless already changed)
            if ($variant->getProduct() === $this) {
                $variant->setProduct(null);
            }
        }

        return $this;
    }

    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
            $category->addProduct($this);
        
        }

        return $this;
    }

    public function addCategories(array $categories): self
    {
        /**
         * @var Category $category
         */
        
        foreach ($categories as $category) {
            $this->addCategory($category);
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->categories->removeElement($category)) {
            $category->removeProduct($this);
        }

        return $this;
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

    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains(($image))) {
            $this->images->add($image);
            $image->setProduct($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        $this->images->removeElement($image);

        return $this;
    }
}