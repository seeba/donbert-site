<?php

declare(strict_types=1);

namespace App\Product\Domain\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

final class Category
{
    
    private function __construct(
        private CategoryId $id,
        private $name,
        private ?CategoryId $parentId = null,
        private Collection $products = new ArrayCollection()
    )
    {       
    }

    public static function create(
        CategoryId $id,
        string $name,
        ?CategoryId $parentId = null,
        Collection $products = new ArrayCollection()
    ): self {

        $category = new self($id, $name, $parentId, $products);
        return $category;
    }

    public static function restore(
        CategoryId $id,
        string $name,
        CategoryId $parentId,
        Collection $products = new ArrayCollection()
    ): self {

        $category = new self($id, $name, $parentId, $products);

        return $category;
    }

    public function getId(): CategoryId
    {
        return $this->id;
    }

    public function getParentId(): ?CategoryId
    {
        return $this->parentId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
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