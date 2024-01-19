<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\IdGenerator;

use App\Shared\Application\Service\IdGeneratorInterface;
use App\Shared\Domain\Model\Id;
use Ramsey\Uuid\Uuid;

final class IdGenerator implements IdGeneratorInterface
{
    public function generate(): Id
    {
        return new Id(Uuid::uuid7()->toString());
    }
}