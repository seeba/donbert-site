<?php

declare(strict_types=1);

namespace App\Product\Application\Query;

interface GetThicknessAttributesQueryInterface
{
    public function execute(): ?array;
}