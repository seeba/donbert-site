<?php

declare(strict_types=1);

namespace App\Product\Domain\Model;

use Doctrine\Common\Collections\Collection;

final class Product
{
    
    private function __construct(
        private ProductId $id,
        private string $name,
        private Collection $categories = null
    )
    {}

    public static function create(
        ProductId $id,
        string $name,
        $categories = null
    ): self {

        $product = new self($id, $name, $categories);
        return $product;
    }

    public static function restore(
        ProductId $id,
        string $name,
        $categories = null
    ): self {

        $product = new self($id, $name, $categories);
        return $product;
    }

    public function getId(): ProductId
    {
        return $this->id;
    }

    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->addProduct($this);
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

    public function getName(): string
    {
        return $this->name;
    }
}