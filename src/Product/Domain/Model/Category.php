<?php

declare(strict_types=1);

namespace App\Product\Domain\Model;

final class Category
{
    
    private function __construct(
        private CategoryId $id,
        private $name,
        private ?CategoryId $parentId = null
    )
    {
        
    }

    public static function create(
        CategoryId $id,
        string $name,
        ?CategoryId $parentId = null
    ): self {

        $category = new self($id, $name, $parentId);
        return $category;
    }

    public static function restore(
        CategoryId $id,
        string $name,
        CategoryId $parentId
    ): self {

        $category = new self($id, $name, $parentId);

        return $category;
    }

    public function getId(): CategoryId
    {
        return $this->id;
    }

    public function getParentId(): CategoryId
    {
        return $this->parentId;
    }

    public function getName(): string
    {
        return $this->name;
    }
}