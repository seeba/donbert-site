<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\Query;

use App\Product\Application\Query\GetQuantityPerRollAttributesQueryInterface;
use App\Product\Infrastructure\Entity\Attribute\QuantityPerRollAttribute;
use Doctrine\ORM\EntityManagerInterface;

class GetQuantityPerRollAttributesQuery implements GetQuantityPerRollAttributesQueryInterface

{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {
    }

    public function execute() :array
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();

        $queryBuilder
            ->select(
                'a.id',
                'a.name'
                )
            ->from(QuantityPerRollAttribute::class, 'a')
            ;

        $results = $queryBuilder->getQuery()->getArrayResult();

        return $results;       
    }
}