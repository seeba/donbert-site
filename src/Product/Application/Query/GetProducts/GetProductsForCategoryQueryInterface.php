<?php

declare(strict_types=1);

namespace App\Product\Application\Query\GetProducts;

interface GetProductsForCategoryQueryInterface
{
    public function execute(string $categoryId): ?array;
}