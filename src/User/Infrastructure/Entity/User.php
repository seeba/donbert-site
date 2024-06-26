<?php

declare(strict_types=1);

namespace App\User\Infrastructure\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
#[ORM\Table(name:"users")]
class User 
{
    #[ORM\Id]
    #[ORM\Column(type:Types::GUID)]
    private string $id;

    #[ORM\Column(type:Types::STRING, unique:true)]
    private string $email;

    #[ORM\Column(type:Types::STRING)]
    private string $password;

    #[ORM\Column(type:Types::JSON)]
    private array $roles = [];

    public function __construct(
        string $id,
        string $email,
        string $password,
        array $roles = [],
    ) { 
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->roles = $roles; 
    }

    public function getId(): string
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