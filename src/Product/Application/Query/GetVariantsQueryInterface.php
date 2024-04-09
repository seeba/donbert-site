<?php

declare(strict_types=1);

namespace App\Product\Application\Query;

interface GetVariantsQueryInterface
{
    public function execute(string $productId): ?array;
}