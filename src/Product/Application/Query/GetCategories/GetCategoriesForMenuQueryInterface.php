<?php

declare(strict_types=1);

namespace App\Product\Application\Query\GetCategories;

interface GetCategoriesForMenuQueryInterface
{
    public function execute(): ?array;
}