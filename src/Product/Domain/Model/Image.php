<?php

declare(strict_types=1);

namespace App\Product\Domain\Model;

use App\Shared\Domain\Aggregate\AggregateRoot;

final class Image extends AggregateRoot
{
    
    private function __construct(
        private ImageId $id,
        private string $originalName,
        private string $fileName,
        private string $mimeType,
        private array $urls
    )
    {}

    public static function create(
        ImageId $id,
        string $originalName,
        string $fileName,
        string $mimeType,
        array $urls
        
    ): self {

        $image = new self($id, $originalName, $fileName, $mimeType, $urls);
        return $image;
    }

    public static function restore(
        ImageId $id,
        string $originalName,
        string $fileName,
        string $mimeType,
        array $urls
        
    ): self {

        $image = new self($id, $originalName, $fileName, $mimeType, $urls);
        return $image;
    }

    public function getId(): ImageId
    {
        return $this->id;
    }

}