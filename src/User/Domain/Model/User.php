<?php

declare(strict_types=1);

namespace App\User\Domain\Model;

use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    public function __construct(
        private UserId $id,
        private string $email,
        private string $password,
        private array $roles = [],
    ) {  
    }

    public static function create(
        UserId $id,
        string $email,
        string $password
    ): self {
        return new self($id, $email, $password);
    }

    public static function restore(
        UserId $id,
        string $email,
        string $password
    ): self {
        return new self($id, $email, $password);
    }

    public function getId(): UserId
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function getSalt(): ?string
    {
        return null;
    }

    public function getUsername(): string
    {
        return $this->email;
    }

    public function eraseCredentials(): void
    {
        // If you had temporary sensitive data on this entity, clear it here
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }
}