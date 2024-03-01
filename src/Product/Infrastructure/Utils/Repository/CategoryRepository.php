<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\Utils\Repository;

use App\Product\Domain\Exception\CategoryNotFoundException;
use App\Product\Domain\Model\Category;
use App\Product\Domain\Model\CategoryId;
use App\Product\Domain\Repository\CategoryRepositoryInterface as CategoryDomainRepositoryInterface;
use App\Product\Infrastructure\Repository\CategoryRepository as DoctrineCategoryRepository;
use App\Product\Infrastructure\Utils\Transformer\CategoryTransformer;
use Doctrine\Common\Collections\ArrayCollection;

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

    public function findAll() : ArrayCollection
    {
        $categories = $this->repository->findAll();

        $domainCategories = new ArrayCollection();

        foreach ($categories as $category) {
            
            $domainCategories->add($this->transformer->toDomain($category));
        }
      
        return $domainCategories;
    }

    public function findByIds(array $ids): ArrayCollection
    {
        $categories = $this->repository->findByIds($ids);
       
        $domainCategories = new ArrayCollection();

        foreach ($categories as $category) {
            
            $domainCategories->add($this->transformer->toDomain($category));
        }
      
        return $domainCategories;
    }
}