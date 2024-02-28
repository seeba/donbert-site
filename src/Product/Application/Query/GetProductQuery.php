<?php

declare(strict_types=1);

namespace App\Product\Application\Query;

use App\Product\Application\Query\Result\Product;

interface GetProductQuery
{
    public function execute(string $id): ?Product;
}