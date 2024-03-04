<?php

declare(strict_types=1);

namespace App\Newsletter\Infrastructure\Utils\Repository;

use App\Newsletter\Domain\Model\NewsletterConsent;
use App\Newsletter\Domain\Repository\NewsletterConsentRepositoryInterface;
use App\Newsletter\Infrastructure\Repository\NewsletterConsentRepositiory as DoctrineNewsletterConsentRepository;
use App\Newsletter\Infrastructure\Utils\Transformer\NewsletterConsentTransformer;

final class NewsletterConsentRepositiory implements NewsletterConsentRepositoryInterface
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
            $this->transformer->fromDomain($newsletterConsent);
        )
    }
}