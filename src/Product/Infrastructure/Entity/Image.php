<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\Entity;

use App\Product\Infrastructure\Entity\Attribute\Attribute;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
#[ORM\Table(name:"images")]
class Image
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

    #[ORM\ManyToOne(targetEntity:"App\Product\Infrastructure\Entity\Variant", inversedBy:"images")]
    #[ORM\JoinColumn(nullable:false)]
    private $variant;

    public function __construct(
        string $id,
        string $originalName,
        string $fileName,
        string $mimeType,
        string $urls
    )
    {
        $this->id = $id;
        $this->originalName = $originalName;
        $this->fileName = $fileName;
        $this->mimeType = $mimeType;
        $this->urls = $urls;
       
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

    

}