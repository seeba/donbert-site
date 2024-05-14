<?php

declare(strict_types=1);

namespace App\Product\Application\Query;

interface GetAttributesQueryInterface
{
    public function execute(): ?array;
}