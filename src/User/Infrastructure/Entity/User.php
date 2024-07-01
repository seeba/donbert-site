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

    #[ORM\Column(type:Types::BOOLEAN, options:["default" => false] )]
    private bool $isActive = false;

    #[ORM\OneToOne(
        targetEntity:"App\User\Infrastructure\Entity\ProfileImage",
        mappedBy:"user",
        cascade: ["persist", "remove"]
        )]
    private ?ProfileImage $profileImage = null;

    public function __construct(
        string $id,
        string $email,
        string $password,
        array $roles = [],
        bool $isActive = false
    ) { 
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->roles = $roles; 
        $this->isActive = $isActive;
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

    public function setPassword(string $password): void
    {
        $this->password = $password;
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

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function setActive(bool $isActive): void
    {
        $this->isActive = $isActive;
    }

    public function getProfileImage(): ?ProfileImage
    {
        return $this->profileImage;
    }

    public function setProfileImage(?ProfileImage $profileImage): void
    {
        $this->profileImage = $profileImage;

        // Set the owning side of the relation if necessary
        if ($profileImage !== null && $profileImage->getUser() !== $this) {
            $profileImage->setUser($this);
        }
    }
}