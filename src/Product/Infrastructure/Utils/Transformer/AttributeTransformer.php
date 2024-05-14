<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\Utils\Transformer;

use App\Product\Domain\Model\Attribute\Attribute;
use App\Product\Domain\Model\Attribute\AttributeId;
use App\Product\Domain\Model\Attribute\ColorAttribute;
use App\Product\Domain\Model\Attribute\SizeAttribute;
use App\Product\Domain\Model\Attribute\ThicknessAttribute;
use App\Product\Domain\Model\Attribute\QuantityPerRollAttribute;
use App\Product\Infrastructure\Entity\Attribute\Attribute as AttributeEntity;
use App\Product\Infrastructure\Entity\Attribute\ColorAttribute as ColorAttributeEntity;
use App\Product\Infrastructure\Entity\Attribute\SizeAttribute as SizeAttributeEntity;
use App\Product\Infrastructure\Entity\Attribute\ThicknessAttribute as ThicknessAttributeEntity;
use App\Product\Infrastructure\Entity\Attribute\QuantityPerRollAttribute as QuantityPerRollAttributeEntity;
use App\Product\Infrastructure\Repository\AttributeRepository;

final class AttributeTransformer
{
    public function __construct(
        private AttributeRepository $attributeRepository,
    ) {     
    }

    public function fromDomain(Attribute $attribute): AttributeEntity
    {  
        $attributeEntity = $this->attributeRepository->find($attribute->getId()->toString());

        if ($attributeEntity === null) {
            $attributeEntity = match(true) {
                $attribute instanceof ColorAttribute => $this->prepareColorAttributeEntity($attribute),
                $attribute instanceof SizeAttribute => $this->prepareSizeAttributeEntity($attribute),
                $attribute instanceof ThicknessAttribute => $this->prepareThicknessAttributeEntity($attribute),
                $attribute instanceof QuantityPerRollAttribute => $this->prepareQuantityPerRollAttributeEntity($attribute)
            };
        }

        return $attributeEntity;
    }

    private function prepareColorAttributeEntity(ColorAttribute $attribute): ColorAttributeEntity
    {
        $attributeEntity = new ColorAttributeEntity(
            $attribute->getId()->toString(),
            $attribute->getName(),
            $attribute->getColor()
        );

        return $attributeEntity;
    }

    private function prepareSizeAttributeEntity(SizeAttribute $attribute): SizeAttributeEntity
    {
        $attributeEntity = new SizeAttributeEntity(
            $attribute->getId()->toString(),
            $attribute->getName(),
            (int) $attribute->getWidth(),
            (int) $attribute->getHeight()
        );

        return $attributeEntity;
    }

    private function prepareThicknessAttributeEntity(ThicknessAttribute $attribute): ThicknessAttributeEntity
    {
        $attributeEntity = new ThicknessAttributeEntity(
            $attribute->getId()->toString(),
            $attribute->getName(),
            $attribute->getThickness()
        );

        return $attributeEntity;
    }

    private function prepareQuantityPerRollAttributeEntity(QuantityPerRollAttribute $attribute): QuantityPerRollAttributeEntity
    {
        $attributeEntity = new QuantityPerRollAttributeEntity(
            $attribute->getId()->toString(),
            $attribute->getName(),
            $attribute->getQuantity()
        );

        return $attributeEntity;
    }

    public function toDomain(AttributeEntity $attributeEntity) : Attribute
    {
        
        return match(true) {
            $attributeEntity instanceof ColorAttributeEntity => $this->prepareColorAttributeDomain($attributeEntity),
            $attributeEntity instanceof SizeAttributeEntity => $this->prepareSizeAttributeDomain($attributeEntity),
            $attributeEntity instanceof ThicknessAttributeEntity => $this->prepareThicknessAttributeDomain($attributeEntity),
            $attributeEntity instanceof QuantityPerRollAttributeEntity => $this->prepareQuantityPerRollAttributeDomain($attributeEntity)
        };

    }

    private function prepareSizeAttributeDomain(SizeAttributeEntity $attributeEntity): SizeAttribute
    {
        return SizeAttribute::restore(
            new AttributeId($attributeEntity->getId()),
            $attributeEntity->getName(),
            $attributeEntity->getWidth(),
            $attributeEntity->getHeight()
        );
    }

    private function prepareColorAttributeDomain(ColorAttributeEntity $attributeEntity): ColorAttribute
    {
        return ColorAttribute::restore(
            new AttributeId($attributeEntity->getId()), 
            $attributeEntity->getName(),
            $attributeEntity->getColor()
            
        );
    }

    private function prepareThicknessAttributeDomain(ThicknessAttributeEntity $attributeEntity): ThicknessAttribute
    {
        return ThicknessAttribute::restore(
            new AttributeId($attributeEntity->getId()), 
            $attributeEntity->getName(),
            $attributeEntity->getThickness()
            
        );
    }

    private function prepareQuantityPerRollAttributeDomain(QuantityPerRollAttributeEntity $attributeEntity): QuantityPerRollAttribute
    {
        return QuantityPerRollAttribute::restore(
            new AttributeId($attributeEntity->getId()), 
            $attributeEntity->getName(),
            $attributeEntity->getQuantity()
            
        );
    }
}