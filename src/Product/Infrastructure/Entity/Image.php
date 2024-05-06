<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\Entity;

use App\Product\Infrastructure\Entity\Attribute\Attribute;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity()]
#[ORM\Table(name:"images")]
#[UniqueEntity(fields:["variant", "main"], message:"Tylko jedno zdjęcie może być główne")]
class Image
{
    #[ORM\Id]
    #[ORM\Column(type:Types::GUID)]
    private string $id;

    #[ORM\Column(type:Types::BOOLEAN)]
    private bool $main;

    #[ORM\Column(type:Types::STRING, length:255)]
    private string $originalName;

    #[ORM\Column(type:Types::STRING, length:255)]
    private string $fileName;

    #[ORM\Column(type:Types::STRING, length:255)]
    private string $mimeType;

    #[ORM\Column(type:Types::JSON, length:255)]
    private string $urls;

    #[ORM\ManyToOne(targetEntity:"App\Product\Infrastructure\Entity\Variant", inversedBy:"images")]
    #[ORM\JoinColumn(nullable:false)]
    private $variant;

    public function __construct(
        string $id,
        bool $main,
        string $originalName,
        string $fileName,
        string $mimeType,
        array $urls
    )
    {
        $this->id = $id;
        $this->main = $main;
        $this->originalName = $originalName;
        $this->fileName = $fileName;
        $this->mimeType = $mimeType;
        $this->urls = json_encode($urls);
       
    }

    public function getVariant(): ?Variant
    {
        return $this->variant;
    }

    public function setVariant(?Variant $variant): self
    {
        $this->variant = $variant;

        return $this;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getMain(): bool
    {
        return $this->main;
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