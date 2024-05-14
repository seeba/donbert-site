<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\Utils\Transformer;

use App\Product\Domain\Model\VariantId;
use App\Product\Domain\Model\Variant;
use App\Product\Infrastructure\Entity\Variant as VariantEntity;
use App\Product\Infrastructure\Entity\Image as ImageEntity;
use App\Product\Infrastructure\Entity\Attribute\Attribute as AttributeEntity;
use App\Product\Infrastructure\Repository\VariantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

final class VariantTransformer
{
    public function __construct(
        private VariantRepository $variantRepository,
        private ImageTransformer $imageTransformer,
        private AttributeTransformer $attributeTransformer
    ) {     
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

        $attributes = $variant->getAttributes();

        foreach ($attributes as $attribute) {
            if ($attribute !== null) {
                $variantEntity->addAttribute($this->attributeTransformer->fromDomain($attribute));
            }
            
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

        /**
         * @var ImageEntity $image
         */
        foreach($images as $image) {
            $variant->addImage($this->imageTransformer->toDomain($image));
        }

        $attributes = $variantEntity->getAtrributes();
            /**
         * @var AttributeEntity $attribute
         */
        foreach ($attributes as $attribute) {
            $variant->addAttribute($this->attributeTransformer->toDomain($attribute));
        }

        return $variant;
    }
}