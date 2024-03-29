<?php

declare(strict_types=1);

namespace App\Newsletter\Domain\Model;

use App\Newsletter\Domain\Model\NewsletterConsentId;
use App\Shared\Domain\Aggregate\AggregateRoot;
use App\Shared\Domain\ValueObject\Email;
use DateTime;

final class NewsletterConsent extends AggregateRoot
{
    private function __construct(
        private NewsletterConsentId $id,
        private Email $email,
        private DateTime $createdAt

    )
    {
    }

    public static function create(
        NewsletterConsentId $id,
        Email $email, 
        DateTime $createdAt
    ): self {
        $newsletterConsent = new self($id, $email, $createdAt);

        return $newsletterConsent;
    }

    public static function restore(
        NewsletterConsentId $id,
        Email $email, 
        DateTime $createdAt
    ): self {
        $newsletterConsent = new self($id, $email, $createdAt);

        return $newsletterConsent;
    }

    public function getId(): NewsletterConsentId
    {
        return $this->id;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }
}