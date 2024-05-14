<?php

declare(strict_types=1);

namespace App\Product\Application\Query;

interface GetColorAttributesQueryInterface
{
    public function execute(): ?array;
}