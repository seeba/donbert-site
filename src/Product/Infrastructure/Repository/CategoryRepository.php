<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\Repository;

use App\Product\Infrastructure\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;

final class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(
        private EntityManagerInterface $entityManager
    )
    {
    }
    public function save(Category $category): void
    {
        $this->entityManager->persist($category);
    }
}