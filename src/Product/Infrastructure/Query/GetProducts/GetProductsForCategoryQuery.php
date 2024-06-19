<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\Query\GetProducts;

use App\Product\Application\Query\GetProducts\GetProductsForCategoryQueryInterface;
use App\Product\Infrastructure\Entity\Category;
use App\Product\Infrastructure\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;

final class GetProductsForCategoryQuery implements GetProductsForCategoryQueryInterface

{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {
    }

    public function execute(string $slug) :?array
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();

        $result =  $queryBuilder
            ->select('c')
            ->from(Category::class, 'c')
            ->innerJoin('c.products', 'p')
            ->leftJoin('p.variants', 'v')
            ->leftJoin('v.attributes', 'va')
            ->leftJoin('v.images', 'vi')
            ->leftJoin('p.attributes', 'a')
            ->addSelect('p')
            ->addSelect('v')
            ->addSelect('a')
            ->addSelect('va')
            ->addSelect('vi')
            ->where('c.slug = :slug')
            ->setParameter('slug', $slug)
            ->getQuery()
            ->getArrayResult();

        if (empty($result)) {
            return null;
        }

        return $result[0];
    }
}