<?php 

declare(strict_types=1);

namespace App\Newsletter\Application\Command;

use App\Newsletter\Application\Command\AddToNewsletterFromSiteCommand;
use App\Newsletter\Domain\Model\NewsletterConsent;
use App\Newsletter\Domain\Model\NewsletterConsentId;
use App\Newsletter\Domain\Repository\NewsletterConsentRepositoryInterface;

use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class AddToNewsletterFromSiteHandler
{
    public function __construct(
        private NewsletterConsentRepositoryInterface $newsletterConsentRepository
    )
    {
        
    }

    public function __invoke(AddToNewsletterFromSiteCommand $command)
    {
        $newsletterConsent = NewsletterConsent::create(
            new NewsletterConsentId($command->id),
            $command->email,
            $command->createdAt
        );

        $this->newsletterConsentRepository->save($newsletterConsent);
    }
}