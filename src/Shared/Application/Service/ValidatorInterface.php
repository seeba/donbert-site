<?php

declare(strict_types=1);

namespace App\Shared\Application\Service;

interface ValidatorInterface
{
    public function validate(CanBeValidatedInterface $object): bool;
}