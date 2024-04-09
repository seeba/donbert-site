<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\Query;

use App\Product\Application\Query\GetVariantsQueryInterface;
use App\Product\Infrastructure\Entity\Variant;
use Doctrine\ORM\EntityManagerInterface;

final class GetVariantsQuery implements GetVariantsQueryInterface

{
    public function __construct(
        private EntityManagerInterface $entityManager
    )
    {
    }

    public function execute(string $productId) :array
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();

        $queryBuilder
            ->select(
                'v.id',
                'v.name'
                )
            ->from(Variant::class, 'v');

        $results = $queryBuilder->getQuery()->getArrayResult();

        return $results;
        
    }
}