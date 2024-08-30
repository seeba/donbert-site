<?php

declare(strict_types=1);

namespace App\Product\Domain\Model;

use App\Product\Domain\Model\Attribute\Attribute;
use App\Shared\Domain\Aggregate\AggregateRoot;

final class Product extends AggregateRoot
{
    private function __construct(
        private ProductId $id,
        private string $name,
        private array $categories = [],
        private array $variants = [],
        private array $attributes = [],
        private array $images = []
    )
    {}

    public static function create(
        ProductId $id,
        string $name,
    
    ): self {
        return  new self($id, $name);
    }

    public static function restore(
        ProductId $id,
        string $name,
       
    ): self {

        $product = new self($id, $name);
        return $product;
    }

    public function getId(): ProductId
    {
        return $this->id;
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

    public function getCategories(): array
    {
        return $this->categories;
    }

    public function addCategory(Category $category): self
    {
        if (!in_array($category, $this->categories, true)) {
            $this->categories[] = $category;
            $category->addProduct($this);
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        // if ($this->categories->removeElement($category)) {
        //     $category->removeProduct($this);
        // }

        return $this;
    }

    public function getVariants(): array
    {
        return $this->variants;
    }

    public function addVariant(Variant $variant): self
    {
        if (!in_array($variant, $this->variants, true)) {
            $this->variants[] = $variant;
            
        }

        return $this;
    }

    public function removeVariant(Variant $variant): self
    {
        // if ($this->categories->removeElement($category)) {
        //     $category->removeProduct($this);
        // }

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function addAttribute(Attribute $attribute): self
    {
        if (!in_array($attribute, $this->attributes, true)) {
            $this->attributes[] = $attribute;
        }

        return $this;
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }
}