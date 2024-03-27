<?php

declare(strict_types=1);

namespace App\Product\Domain\Model;

use App\Shared\Domain\Aggregate\AggregateRoot;
use Doctrine\Common\Collections\Collection;

final class Image extends AggregateRoot
{
    
    private function __construct(
        private ImageId $id,
        private string $fileName,
        private string $url
    )
    {}

    public static function create(
        ImageId $id,
        string $fileName,
        string $url
        
    ): self {

        $image = new self($id, $fileName, $url);
        return $image;
    }

    public static function restore(
        ImageId $id,
        string $fileName,
        string $url
        
    ): self {

        $image = new self($id, $fileName, $url);
        return $image;
    }

    public function getId(): ImageId
    {
        return $this->id;
    }

}