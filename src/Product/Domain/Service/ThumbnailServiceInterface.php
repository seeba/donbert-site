<?php

declare(strict_types=1);

namespace App\Product\Domain\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

interface ThumbnailServiceInterface 
{
    public function generateThumbs(UploadedFile $file, string $filename, string $variantId): array;
}