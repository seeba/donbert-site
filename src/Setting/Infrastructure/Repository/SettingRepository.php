<?php

declare(strict_types=1);

namespace App\Setting\Infrastructure\Repository;

use App\Setting\Infrastructure\Entity\Setting;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class SettingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Setting::class);
    }

    public function save(Setting $setting): void
    {
        $this->getEntityManager()->persist($setting);
        $this->getEntityManager()->flush();
    }

    public function findByName(string $name) 
    {
        $qb = $this->createQueryBuilder('s')
            ->where('s.name = :name')
            ->setParameter('name', $name)
            ->getQuery();
        
        return $qb->getOneOrNullResult();
    }
}