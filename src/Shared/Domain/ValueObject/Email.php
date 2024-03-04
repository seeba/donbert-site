<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

use InvalidArgumentException;

class Email
{
    /**
     * @var string
     */
    private $email;

    private function __construct(string $email)
    {
        $this->ensureIsValidEmail($email);
        $this->email = $email;
    }

    public static function fromString(string $email): self
    {
        return new self($email);
    }

    private function ensureIsValidEmail(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException(sprintf('"%s" nie jest poprawnym adresem email.', $email));
        }
    }

    public function toString(): string 
    {
        return $this->email;
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}