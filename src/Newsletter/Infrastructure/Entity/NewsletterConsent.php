<?php

declare(strict_types=1);

namespace App\Newsletter\Infrastructure\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
#[ORM\Table(name:"newsletter_consents")]
class NewsletterConsent 
{

    #[ORM\Id]
    #[ORM\Column(type:Types::GUID)]
    private string $id;

    #[ORM\Column(type:Types::STRING, length:255)]
    private string $email;

    public function __construct(
        string $id,
        string $email
    )
    {
        $this->id = $id;
        $this->email = $email;
    }

}