<?php

declare(strict_types=1);

namespace App\User\Infrastructure\Utils\Transformer;

use App\User\Domain\Model\User;
use App\User\Infrastructure\Entity\User as UserEntity;

class UserTransformer
{
    public function __construct(
        
    ) {   
    }
    public function fromDomain(User $user): UserEntity
    {

    }

    public function toDomain(UserEntity $userEntity): User
    {

    }
}
