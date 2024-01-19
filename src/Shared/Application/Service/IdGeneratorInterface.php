<?php

declare(strict_types=1);

namespace App\Shared\Application\Service;

use App\Shared\Domain\Model\Id;

interface IdGeneratorInterface
{
    public function generate(): Id;
}