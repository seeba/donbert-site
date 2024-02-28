<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\Query;

use Doctrine\ORM\EntityManagerInterface;

final class GetProductQuery
{
    public function __construct(
        private EntityManagerInterface $entityManager
    )
    {
    }

    public function execute(string $id) 
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();
        
    }
}