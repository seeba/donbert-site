<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\Utils\Repository;

use App\Product\Domain\Exception\ProductNotFoundException;
use App\Product\Domain\Model\ProductId;
use App\Product\Domain\Model\Product;
use App\Product\Domain\Repository\ProductRepositoryInterface as ProductDomainRepositoryInterface;
use App\Product\Infrastructure\Repository\ProductRepository as DoctrineProductRepository;
use App\Product\Infrastructure\Utils\Transformer\ProductTransformer;
use Doctrine\Common\Collections\Collection;

final class ProductRepository implements ProductDomainRepositoryInterface
{
    public function __construct(
        private DoctrineProductRepository $repository,
        private ProductTransformer $transformer,
    ) {    
    }

    public function save(Product $product): void
    {
        $this->repository->save(
            $this->transformer->fromDomain($product)
        );
    }
    /**
     * @throws ProductNotFoundException
     */
    public function get(ProductId $id): Product
    {
        
        $entity = $this->repository->find($id->toString());
        return $entity === null 
            ? throw new ProductNotFoundException() 
            : $this->transformer->toDomain($entity);
    }

    public function findAll() : Collection
    {
        /** @var Collection $categories */
        $categories = $this->repository->findAll();

        return $categories;
    }
}