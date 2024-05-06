<?php

declare(strict_types=1);

namespace App\Product\Domain\Model;

use App\Shared\Domain\Aggregate\AggregateRoot;

final class Image extends AggregateRoot
{
    
    private function __construct(
        private ImageId $id,
        private bool $main,
        private string $originalName,
        private string $fileName,
        private string $mimeType,
        private array $urls
    )
    {}

    public static function create(
        ImageId $id,
        bool $main,
        string $originalName,
        string $fileName,
        string $mimeType,
        array $urls
        
    ): self {

        $image = new self($id, $main, $originalName, $fileName, $mimeType, $urls);
        return $image;
    }

    public static function restore(
        ImageId $id,
        bool $main,
        string $originalName,
        string $fileName,
        string $mimeType,
        array $urls
        
    ): self {

        $image = new self($id, $main, $originalName, $fileName, $mimeType, $urls);
        return $image;
    }

    public function getId(): ImageId
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
        return $this->urls;
    }
}