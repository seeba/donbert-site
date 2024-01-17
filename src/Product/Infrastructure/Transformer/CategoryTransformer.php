<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\Utils\Transformer;

use App\Product\Domain\Model\Category;
use App\Product\Domain\Model\CategoryId;
use App\Product\Infrastructure\Entity\Category as CategoryEntity;
use App\Product\Infrastructure\Repository\CategoryRepository;

final class CategoryTransformer
{
    public function __construct(
        private CategoryRepository $categoryRepository
    )
    {     
    }

    public function fromDomain(Category $category): CategoryEntity
    {
        $categoryEntity = $this->categoryRepository->find($category->getId()->toString());
        if ($categoryEntity === null) {

        }

        return $categoryEntity;
    }

    public function toDomain(CategoryEntity $categoryEntity) : Category
    {
        return Category::restore(
            new CategoryId($categoryEntity->getId()),
            $categoryEntity->getName(),
            new CategoryId($categoryEntity->getParent()->getId())
        );
    }
}