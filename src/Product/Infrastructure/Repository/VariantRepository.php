<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\Repository;

use App\Product\Infrastructure\Entity\Variant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class VariantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Variant::class);
    }
    public function save(Variant $variant): void
    {
        $this->getEntityManager()->persist($variant);
        $this->getEntityManager()->flush();
    }
}