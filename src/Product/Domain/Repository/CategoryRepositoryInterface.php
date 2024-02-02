<?php

declare(strict_types=1);

namespace App\Product\Domain\Repository;

use App\Product\Domain\Model\Category;
use App\Product\Domain\Model\CategoryId;

interface CategoryRepositoryInterface
{
    public function get(CategoryId $id): Category;

    public function save(Category $category): void;

    public function findAll(): array;
}