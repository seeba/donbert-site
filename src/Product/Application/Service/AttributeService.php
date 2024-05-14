<?php

declare(strict_types=1);

namespace App\Product\Application\Service;

use App\Product\Application\Query\GetColorAttributesQueryInterface;
use App\Product\Application\Query\GetQuantityPerRollAttributesQueryInterface;
use App\Product\Application\Query\GetSizeAttributesQueryInterface;
use App\Product\Application\Query\GetThicknessAttributesQueryInterface;
use App\Product\Domain\Service\AttributeServiceInterface;

class AttributeService implements AttributeServiceInterface
{
    public function __construct(
        private GetSizeAttributesQueryInterface $getSizeAttributesQuery,
        private GetColorAttributesQueryInterface $getColorAttributesQuery,
        private GetThicknessAttributesQueryInterface $getThicknessAttributesQuery,
        private GetQuantityPerRollAttributesQueryInterface $getQuantityPerRollAttributesQuery
    ) { 
    }

    public function getSizeAttributesToForm(): array
    {
        $attributes = $this->getSizeAttributesQuery->execute();
        $choices = [];
       
        foreach ($attributes as $attribute) {
            $choices[$attribute['name']] = $attribute['id'];
        }

        return $choices;
    }

    public function getColorAttributesToForm(): array
    {
        $attributes = $this->getColorAttributesQuery->execute();
        $choices = [];
        foreach ($attributes as $attribute) {
            $choices[$attribute['name']] = $attribute['id'];
        }

        return $choices;
    }

    public function getThicknessAttributesToForm(): array
    {
        $attributes = $this->getThicknessAttributesQuery->execute();

        foreach ($attributes as $attribute) {
            $choices[$attribute['name']] = $attribute['id'];
        }

        return $choices;
    }

    public function getQuantityPerRollAttributesToForm(): array
    {
        $attributes = $this->getQuantityPerRollAttributesQuery->execute();
        $choices = [];
        foreach ($attributes as $attribute) {
            $choices[$attribute['name']] = $attribute['id'];
        }

        return $choices;
    }
}