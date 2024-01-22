<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\Repository;

use App\Product\Infrastructure\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }
    public function save(Category $category): void
    {
        $this->getEntityManager()->persist($category);
    }
}