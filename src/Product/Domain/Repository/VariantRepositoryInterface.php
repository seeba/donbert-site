<?php

declare(strict_types=1);

namespace App\Product\Domain\Repository;

use App\Product\Domain\Model\Variant;
use App\Product\Domain\Model\VariantId;
use Doctrine\Common\Collections\Collection;

interface VariantRepositoryInterface
{
    /**
     * @throws VariantNotFoundException
     */
    public function get(VariantId $id): Variant;

    public function save(Variant $variant): void;

    public function findAll(): Collection;
}