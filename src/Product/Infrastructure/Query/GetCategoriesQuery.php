<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\Query;

use App\Product\Application\Query\GetCategoriesQueryInterface;
use App\Product\Infrastructure\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;

final class GetCategoriesQuery implements GetCategoriesQueryInterface

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
                'c.id',
                'c.name'
                )
            ->from(Category::class, 'c');

        $results = $queryBuilder->getQuery()->getArrayResult();

        return $results;
        
    }
}