<?php

declare(strict_types=1);

namespace App\Newsletter\Infrastructure\Utils\Repository;

use App\Newsletter\Domain\Exception\NewsletterConsentNotFoundException;
use App\Newsletter\Domain\Model\NewsletterConsent;
use App\Newsletter\Domain\Repository\NewsletterConsentRepositoryInterface;
use App\Newsletter\Infrastructure\Repository\NewsletterConsentRepository as DoctrineNewsletterConsentRepository;
use App\Newsletter\Infrastructure\Utils\Transformer\NewsletterConsentTransformer;
use App\Newsletter\Domain\Model\NewsletterConsentId;

final class NewsletterConsentRepository implements NewsletterConsentRepositoryInterface
{
    public function __construct(
        private DoctrineNewsletterConsentRepository $repository,
        private NewsletterConsentTransformer $transformer,
    )
    {
    }

    public function save(NewsletterConsent $newsletterConsent): void
    {
        $this->repository->save(
            $this->transformer->fromDomain($newsletterConsent)
        );
    }

    public function get(NewsletterConsentId $id): NewsletterConsent
    {
        $entity = $this->repository->find($id->toString());

        return $entity === null 
            ? throw new NewsletterConsentNotFoundException() 
            : $this->transformer->toDomain($entity);
    }
}