<?php

declare(strict_types=1);

namespace App\Product\Application\Query;

interface GetSizeAttributesQueryInterface
{
    public function execute(): ?array;
}