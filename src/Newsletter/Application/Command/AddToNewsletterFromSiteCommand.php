<?php 

declare(strict_types=1);

namespace App\Newsletter\Application\Command;

use App\Shared\Domain\ValueObject\Email;
use DateTime;

class AddToNewsletterFromSiteCommand 
{
    public function __construct(
        public readonly string $id,
        public readonly Email $email,
        public readonly DateTime $createdAt
    )
    {
    }
    
}