<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\Utils\Repository;

use App\Product\Domain\Exception\CategoryNotFoundException;
use App\Product\Domain\Model\Category;
use App\Product\Domain\Model\CategoryId;
use App\Product\Domain\Repository\CategoryRepositoryInterface as CategoryDomainRepositoryInterface;
use App\Product\Infrastructure\Repository\CategoryRepository as DoctrineCategoryRepository;
use App\Product\Infrastructure\Utils\Transformer\CategoryTransformer;

final class CategoryRepository implements CategoryDomainRepositoryInterface
{
    public function __construct(
        private DoctrineCategoryRepository $repository,
        private CategoryTransformer $transformer,
    )
    {    
    }

    public function save(Category $category): void
    {
        $this->repository->save(
            $this->transformer->fromDomain($category)
        );
    }
    /**
     * @throws ProductNotFoundException
     */
    public function get(CategoryId $id): Category
    {
        $entity = $this->repository->find($id->toString());

        return $entity === null ? throw new CategoryNotFoundException() : $this->transformer->toDomain($entity);
    }

    public function findAll() : array
    {
        $categories = $this->repository->findAll();

        return $categories;
    }
}