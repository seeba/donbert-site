<?php

declare(strict_types=1);

namespace App\Newsletter\Infrastructure\Utils\Transformer;

use App\Newsletter\Domain\Model\NewsletterConsent;
use App\Newsletter\Infrastructure\Entity\NewsletterConsent as NewsletterConsentEntity;
use App\Newsletter\Infrastructure\Repository\NewsletterConsentRepositiory;


final class NewsletterConsentTransformer {

    public function __construct(
        private NewsletterConsentRepositiory $newsletterConsentRepositiory
    )
    {
        
    }

    public function fromDomain(NewsletterConsent $newsletterConsent) 
    {

    }

    public function toDomain(NewsletterConsentEntity $newsletterConsentEntity) 
    {
        
    }

}