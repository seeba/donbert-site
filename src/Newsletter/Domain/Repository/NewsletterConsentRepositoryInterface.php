<?php

declare(strict_types=1);

namespace App\Newsletter\Domain\Repository;

use App\Newsletter\Domain\Model\NewsletterConsent;
use App\Product\Domain\Model\NewsletterConsentId;

interface NewsletterConsentRepositoryInterface 
{
    public function save(NewsletterConsent $newsletterConsent): void;

    public function get(NewsletterConsentId $id): NewsletterConsent;

}