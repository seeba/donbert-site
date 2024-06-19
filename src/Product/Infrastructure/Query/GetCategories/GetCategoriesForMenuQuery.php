<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\Query\GetCategories;

use App\Product\Application\Query\GetCategories\GetCategoriesForMenuQueryInterface;
use App\Product\Infrastructure\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;

class GetCategoriesForMenuQuery implements GetCategoriesForMenuQueryInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {  
    }

    public function execute(): array
    {
        return $this->entityManager->createQueryBuilder()
            ->select('c')
            ->from(Category::class, 'c')
            ->leftJoin('c.children', 'ch') // Używanie aliasu 'c' jako głównego
            ->addSelect('ch') // Dodanie selekcji dla aliasu 'ch'
            ->orderBy('c.name', 'ASC')
            ->where('c.parent is null')
            ->getQuery()
            ->getArrayResult();
    }
}

