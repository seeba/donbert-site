<?php

declare(strict_types=1);

namespace App\Product\Domain\Repository;

use App\Product\Domain\Model\Product;
use App\Product\Domain\Model\ProductId;
use Doctrine\Common\Collections\Collection;

interface ProductRepositoryInterface
{
    public function get(ProductId $id): Product;

    public function save(Product $product): void;

    public function findAll(): Collection;
}