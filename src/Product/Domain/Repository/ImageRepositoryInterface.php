<?php

declare(strict_types=1);

namespace App\Product\Domain\Repository;

use App\Product\Domain\Model\Image;
use App\Product\Domain\Model\ImageId;
use Doctrine\Common\Collections\Collection;

interface ImageRepositoryInterface
{
    /**
     * @throws VariantNotFoundException
     */
    public function get(ImageId $id): Image;

    public function save(Image $image): void;

    public function findAll(): Collection;
}