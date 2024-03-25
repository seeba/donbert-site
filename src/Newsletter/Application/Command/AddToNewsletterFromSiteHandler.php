<?php 

declare(strict_types=1);

namespace App\Newsletter\Application\Command;

use App\Newsletter\Application\Command\AddToNewsletterFromSiteCommand;
use App\Newsletter\Domain\Model\NewsletterConsent;
use App\Newsletter\Domain\Model\NewsletterConsentId;
use App\Newsletter\Domain\Repository\NewsletterConsentRepositoryInterface;
use Exception;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[AsMessageHandler]
class AddToNewsletterFromSiteHandler
{
    public function __construct(
        private NewsletterConsentRepositoryInterface $newsletterConsentRepository,
        private ValidatorInterface $validator
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

        $message = '';
            $errors = $this->validator->validate($newsletterConsent);
        //    dd($errors);
            if ($errors->count() > 0) {
                foreach ($errors as $error) {
                    $message .= $error->getMessage();
                }

            throw new Exception($message);
            }



        $this->newsletterConsentRepository->save($newsletterConsent);
    }
}