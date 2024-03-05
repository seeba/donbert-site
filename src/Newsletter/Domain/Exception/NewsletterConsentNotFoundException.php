<?php

declare(strict_types=1);

namespace App\Newsletter\Domain\Exception;

use App\Shared\Domain\Exception\NotFoundException;

final class NewsletterConsentNotFoundException extends NotFoundException
{
}