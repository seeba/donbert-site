<?php

declare(strict_types=1);

namespace App\Product\Application\Factory;

use App\Product\Application\Command\Sync\CreateAttribute\DTO\CreateAttributeDTO;
use App\Product\Domain\Model\Attribute\AttributeId;
use App\Product\Domain\Model\Attribute\ColorAttribute;
use App\Product\Domain\Model\Attribute\QuantityPerRollAttribute;
use App\Product\Domain\Model\Attribute\SizeAttribute;
use App\Product\Domain\Model\Attribute\ThicknessAttribute;
use App\Product\Domain\ValueObject\AttributeType;

class AttributeFactory
{
    public function produce(CreateAttributeDTO $createAttributeDTO, string $id)
    {
        $attribute = match($createAttributeDTO->type) {
            AttributeType::COLOR => $this->prepareColorAttribute($createAttributeDTO, $id),
            AttributeType::SIZE => $this->prepareSizeAttribute($createAttributeDTO, $id),
            AttributeType::THICKNESS => $this->prepareThicknessAttribute($createAttributeDTO, $id),
            AttributeType::QUANTITY_PER_ROLL => $this->prepareQuantityPerRollAttribute($createAttributeDTO, $id)
        };

        return $attribute;
    }

    private function prepareColorAttribute(CreateAttributeDTO $createAttributeDTO, string $id): ColorAttribute
    {
        $colorAttribute = ColorAttribute::create(
            new AttributeId($id),
            $createAttributeDTO->name,
            $createAttributeDTO->color->toString(),
        );

        return $colorAttribute;
    }

    private function prepareSizeAttribute(CreateAttributeDTO $createAttributeDTO, string $id): SizeAttribute
    {
        $sizeAttribute = SizeAttribute::create(
            new AttributeId($id),
            $createAttributeDTO->name,
            $createAttributeDTO->size->getWidth(),
            $createAttributeDTO->size->getHeight()
        );

        return $sizeAttribute;
    }

    private function prepareThicknessAttribute(CreateAttributeDTO $createAttributeDTO, string $id): ThicknessAttribute
    {
        $attribute = ThicknessAttribute::create(
            new AttributeId($id),
            $createAttributeDTO->name,
            $createAttributeDTO->thickness->getValue()
        );

        return $attribute;
    }

    private function prepareQuantityPerRollAttribute(CreateAttributeDTO $createAttributeDTO, string $id): QuantityPerRollAttribute
    {
        $attribute = QuantityPerRollAttribute::create(
            new AttributeId($id),
            $createAttributeDTO->name,
            $createAttributeDTO->quantityPerRoll->getValue()
        );

        return $attribute;
    }
}