<?php

declare(strict_types=1);

namespace App\Product\Application\Query;

interface GetProductsQueryInterface
{
    public function execute(): ?array;
}