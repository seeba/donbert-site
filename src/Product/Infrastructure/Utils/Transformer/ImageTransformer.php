<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\Utils\Transformer;

use App\Product\Domain\Model\Image;
use App\Product\Domain\Model\ImageId;
use App\Product\Infrastructure\Entity\Image as ImageEntity;
use App\Product\Infrastructure\Repository\ImageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

final class ImageTransformer
{
    public function __construct(
        private ImageRepository $imageRepository,
    )
    {     
    }

    public function fromDomain(Image $image): ImageEntity
    {
        $imageEntity = $this->imageRepository->find($image->getId()->toString());
        if ($imageEntity === null) {
            $imageEntity = new ImageEntity(
                $image->getId()->toString(),
                $image->getMain(),
                $image->getOriginalName(),
                $image->getFileName(),
                $image->getMimeType(),
                $image->getUrls()
            );
        }
    
        return $imageEntity;
    }

    public function toDomain(ImageEntity $imageEntity): Image
    {
        $image =  Image::restore(
            new ImageId($imageEntity->getId()),
            $imageEntity->getMain(),
            $imageEntity->getOriginalName(),
            $imageEntity->getFileName(),
            $imageEntity->getMimeType(),
            $imageEntity->getUrls()
            
        );

        return $image;
    }
}