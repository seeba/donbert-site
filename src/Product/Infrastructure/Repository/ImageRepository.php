<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\Repository;

use App\Product\Infrastructure\Entity\Image;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class ImageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Image::class);
    }
    public function save(Image $image): void
    {
        $this->getEntityManager()->persist($image);
        $this->getEntityManager()->flush();
    }
}