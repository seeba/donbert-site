<?php

declare(strict_types=1);

namespace App\Product\Domain\Model;

use App\Shared\Domain\Aggregate\AggregateRoot;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

final class Product extends AggregateRoot
{
    
    private function __construct(
        private ProductId $id,
        private string $name,
        private array $categories = []
    )
    {}

    public static function create(
        ProductId $id,
        string $name,
    
    ): self {

        $product = new self($id, $name);
        return $product;
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

    public function getName(): string
    {
        return $this->name;
    }
}