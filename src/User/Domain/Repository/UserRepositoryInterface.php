<?php

declare(strict_types=1);

namespace App\User\Domain\Repository;

use App\User\Domain\Model\User;
use App\User\Domain\Model\UserId;

interface UserRepositoryInterface
{
    public function get(UserId $id): User;

    public function save(User $user): void;
}