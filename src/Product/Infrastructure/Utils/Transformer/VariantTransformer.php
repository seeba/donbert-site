<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\Utils\Transformer;

use App\Product\Domain\Model\Category;
use App\Product\Domain\Model\CategoryId;
use App\Product\Domain\Model\VariantId;
use App\Product\Domain\Model\Variant;
use App\Product\Infrastructure\Entity\Variant as VariantEntity;
use App\Product\Infrastructure\Repository\VariantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

final class VariantTransformer
{
    public function __construct(
        private VariantRepository $variantRepository,
        private ImageTransformer $imageTransformer
    )
    {     
    }

    public function fromDomain(Variant $variant): VariantEntity
    {  
        /**
         * @var VariantEntity $variantEntity
         */
        $variantEntity = $this->variantRepository->find($variant->getId()->toString());
        if ($variantEntity === null) {
            $variantEntity = new VariantEntity(
                $variant->getId()->toString(),
                $variant->getName()
            );
        }

        $images = $variant->getImages();

        foreach($images as $image) {
            
            $variantEntity->addImage($this->imageTransformer->fromDomain($image));
        }
    
        return $variantEntity;
    }

    public function toDomain(VariantEntity $variantEntity) : Variant
    {
        $variant =  Variant::restore(
            new VariantId($variantEntity->getId()),
            $variantEntity->getName()
        );

        $images = $variantEntity->getImages();

        foreach($images as $image) {
            $variant->addImage($this->imageTransformer->toDomain($image));
        }

        return $variant;
    }
}