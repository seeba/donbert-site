<?php

declare(strict_types=1);

namespace App\Product\Application\Query;

interface GetQuantityPerRollAttributesQueryInterface
{
    public function execute(): ?array;
}