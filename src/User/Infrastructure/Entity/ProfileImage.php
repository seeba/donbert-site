<?php

declare(strict_types=1);

namespace App\User\Infrastructure\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
#[ORM\Table(name:"profile_images")]
class ProfileImage
{
    #[ORM\Id]
    #[ORM\Column(type:Types::GUID)]
    private string $id;

    #[ORM\Column(type:Types::STRING, length:255)]
    private string $originalName;

    #[ORM\Column(type:Types::STRING, length:255)]
    private string $fileName;

    #[ORM\Column(type:Types::STRING, length:255)]
    private string $mimeType;

    #[ORM\Column(type:Types::JSON, length:255)]
    private string $urls;

    #[ORM\OneToOne(
        targetEntity:"App\User\Infrastructure\Entity\User", 
        inversedBy:"profileImage",
        cascade: ["persist"]
        )]
    #[ORM\JoinColumn(name:"user_id", referencedColumnName:"id", nullable:false)]
    private $user;

    public function __construct(
        string $id,
        string $originalName,
        string $fileName,
        string $mimeType,
        array $urls
    )
    {
        $this->id = $id;
        $this->originalName = $originalName;
        $this->fileName = $fileName;
        $this->mimeType = $mimeType;
        $this->urls = json_encode($urls);
       
    }
    
    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): void
    {
        $this->user = $user;

        // Set the inverse side of the relation if necessary
        if ($user !== null && $user->getProfileImage() !== $this) {
            $user->setProfileImage($this);
        }
    }
    public function getId(): string
    {
        return $this->id;
    }

    public function getOriginalName(): string
    {
        return $this->originalName;
    }

    public function getFileName(): string
    {
        return $this->fileName;
    }

    public function getMimeType(): string
    {
        return $this->mimeType;
    }

    public function getUrls(): array
    {
        return json_decode($this->urls, true);
    }
}

