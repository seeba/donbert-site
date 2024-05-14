<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\Utils\Repository;

use App\Product\Domain\Exception\AttributeNotFoundException;
use App\Product\Domain\Model\Attribute\Attribute;
use App\Product\Domain\Model\Attribute\AttributeId;
use App\Product\Domain\Repository\AttributeRepositoryInterface as AttributeDomainRepositoryInterface;
use App\Product\Infrastructure\Repository\AttributeRepository as DoctrineAttributeRepository;
use App\Product\Infrastructure\Utils\Transformer\AttributeTransformer;
use Doctrine\Common\Collections\Collection;

final class AttributeRepository implements AttributeDomainRepositoryInterface
{
    public function __construct(
        private DoctrineAttributeRepository $repository,
        private AttributeTransformer $transformer,
    ) {    
    }

    public function save(Attribute $attribute): void
    {
        $this->repository->save(
            $this->transformer->fromDomain($attribute)
        );
    }
    
    public function get(AttributeId $id): Attribute
    {
        $entity = $this->repository->find($id->toString());

        return $entity === null ? throw new AttributeNotFoundException() : $this->transformer->toDomain($entity);
    }

    public function findAll() : Collection
    {
        /** @var Collection $attributes */
        $attributes = $this->repository->findAll();

        return $attributes;
    }
}