<?php

declare(strict_types=1);

namespace App\Newsletter\Infrastructure\Repository;

use App\Newsletter\Infrastructure\Entity\NewsletterConsent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class NewsletterConsentRepositiory extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NewsletterConsent::class );
    }

    public function save(NewsletterConsent $newsletterConsent): void
    {
        $this->getEntityManager()->persist($newsletterConsent);
        $this->getEntityManager()->flush();
    }
}