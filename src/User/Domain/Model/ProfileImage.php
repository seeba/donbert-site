<?php

declare(strict_types=1);

namespace App\User\Domain\Model;

class ProfileImage 
{
    private function __construct(
        private ProfileImageId $id,
        private string $originalName,
        private string $fileName,
        private string $mimeType,
        private array $urls
    ) {  
    }

    public static function create(
        ProfileImageId $id,
        string $originalName,
        string $fileName,
        string $mimeType,
        array $urls
        
    ): self {
        return new self($id, $originalName, $fileName, $mimeType, $urls);
    }

    public static function restore(
        ProfileImageId $id,
        string $originalName,
        string $fileName,
        string $mimeType,
        array $urls
        
    ): self {
        return new self($id, $originalName, $fileName, $mimeType, $urls);
    }

    public function getId(): ProfileImageId
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
        return $this->urls;
    }
}
