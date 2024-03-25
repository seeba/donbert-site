<?php

declare(strict_types=1);

namespace App\Newsletter\Infrastructure\Utils\Transformer;

use App\Newsletter\Domain\Model\NewsletterConsent;
use App\Newsletter\Domain\Model\NewsletterConsentId;
use App\Newsletter\Infrastructure\Entity\NewsletterConsent as NewsletterConsentEntity;
use App\Newsletter\Infrastructure\Repository\NewsletterConsentRepository;
use App\Shared\Domain\Exception\IsExistException;
use App\Shared\Domain\ValueObject\Email;
use Exception;
use App\Shared\Application\Service\ValidatorInterface;

final class NewsletterConsentTransformer {

    public function __construct(
        private NewsletterConsentRepository $newsletterConsentRepositiory,
        private ValidatorInterface $validator
    )
    {
        
    }

    public function fromDomain(NewsletterConsent $newsletterConsent): NewsletterConsentEntity
    {
    
        $newsletterConsentEntity = $this->newsletterConsentRepositiory
            ->find($newsletterConsent
                    ->getId()
                    ->toString());
        if($newsletterConsentEntity === null) {
            $newsletterConsentEntity = new NewsletterConsentEntity(
                $newsletterConsent->getId()->toString(),
                $newsletterConsent->getEmail()->toString(),
                $newsletterConsent->getCreatedAt()
            );
        }
        
        $this->validator->validate($newsletterConsentEntity);
        

        return $newsletterConsentEntity;

    }

    public function toDomain(NewsletterConsentEntity $newsletterConsentEntity): NewsletterConsent 
    {
        $newsletterConsent = NewsletterConsent::restore(
            new NewsletterConsentId($newsletterConsentEntity->getId()),
            new Email($newsletterConsentEntity->getEmail()),
            $newsletterConsentEntity->getCreatedAt() 
        );

        return $newsletterConsent;
    }

}