<?php

declare(strict_types=1);

namespace App\Product\Domain\Repository;

use App\Product\Domain\Model\Variant;
use App\Product\Domain\Model\VariantId;
use Doctrine\Common\Collections\Collection;
use App\Product\Domain\Exception\AttributeNotFoundException;
use App\Product\Domain\Model\Attribute\AttributeId;
use App\Product\Domain\Model\Attribute\Attribute;

interface AttributeRepositoryInterface
{
    /**
     * @throws AttributeNotFoundException
     */
    public function get(AttributeId $id): Attribute;

    public function save(Attribute $attribute): void;

    public function findAll(): Collection;
}