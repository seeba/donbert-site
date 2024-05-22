<?php

declare(strict_types=1);

namespace App\Product\Application\Query;

interface GetCategoriesQueryInterface
{
    public function execute(): ?array;
}