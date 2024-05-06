<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\Utils\Repository;

use App\Product\Domain\Exception\ProductNotFoundException;
use App\Product\Domain\Exception\VariantNotFoundException;
use App\Product\Domain\Model\VariantId;
use App\Product\Domain\Model\Variant;
use App\Product\Domain\Repository\VariantRepositoryInterface as VariantDomainRepositoryInterface;
use App\Product\Infrastructure\Repository\VariantRepository as DoctrineVariantRepository;
use App\Product\Infrastructure\Utils\Transformer\VariantTransformer;
use Doctrine\Common\Collections\Collection;

final class VariantRepository implements VariantDomainRepositoryInterface
{
    public function __construct(
        private DoctrineVariantRepository $repository,
        private VariantTransformer $transformer,
    )
    {    
    }

    public function save(Variant $variant): void
    {
        $this->repository->save(
            $this->transformer->fromDomain($variant)
        );
    }
    
    public function get(VariantId $id): Variant
    {
        $entity = $this->repository->find($id->toString());

        return $entity === null ? throw new VariantNotFoundException() : $this->transformer->toDomain($entity);
    }

    public function findAll() : Collection
    {
        /** @var Collection $variants */
        $variants = $this->repository->findAll();

        return $variants;
    }
}