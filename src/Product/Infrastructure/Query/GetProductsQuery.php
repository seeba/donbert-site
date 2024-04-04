<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\Query;

use App\Product\Application\Query\GetProductsQueryInterface;
use App\Product\Infrastructure\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;

final class GetProductsQuery implements GetProductsQueryInterface

{
    public function __construct(
        private EntityManagerInterface $entityManager
    )
    {
    }

    public function execute() :array
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();

        $queryBuilder
            ->select(
                'p.id',
                'p.name'
                )
            ->from(Product::class, 'p');

        $results = $queryBuilder->getQuery()->getArrayResult();

        return $results;
        
    }
}