<?php

declare(strict_types=1);

namespace App\Newsletter\Infrastructure\Entity;

use App\Newsletter\Infrastructure\Repository\NewsletterConsentRepository;
use App\Shared\Application\Service\CanBeValidatedInterface;
use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[UniqueEntity(fields:["email"], message:'Ten adres email został już użyty')]
#[ORM\Entity(repositoryClass:NewsletterConsentRepository::class)]
#[ORM\Table(name:"newsletter_consents")]
class NewsletterConsent implements CanBeValidatedInterface
{

    #[ORM\Id]
    #[ORM\Column(type:Types::GUID)]
    private string $id;

    #[ORM\Column(type:Types::STRING, length:255)]
    #[Assert\Email]
    private string $email;

    #[ORM\Column(type:Types::DATETIME_MUTABLE)]
    private DateTime $createdAt;

    public function __construct(
        string $id,
        string $email, 
        Datetime $createdAt
    )
    {
        $this->id = $id;
        $this->email = $email;
        $this->createdAt = $createdAt;
    }

    public function getId(): string 
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getCreatedAt(): DateTime 
    {
        return $this->createdAt;
    }

}