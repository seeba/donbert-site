<?php

declare(strict_types=1);

namespace App\User\Infrastructure\Utils\Transformer;

use App\User\Domain\Model\User;
use App\User\Domain\Model\UserId;
use App\User\Infrastructure\Entity\User as UserEntity;
use App\User\Infrastructure\Repository\UserRepository;

class UserTransformer
{
    public function __construct(
        private UserRepository $userRepository
        
    ) {   
    }
    public function fromDomain(User $user): UserEntity
    {
        $userEntity = $this->userRepository->find($user->getId()->toString());
        if ($userEntity === null) {
            $userEntity = new UserEntity(
                $user->getId()->toString(),
                $user->getEmail(),
                $user->getPassword(),
                $user->getRoles(),
                $user->isActive()
            );
        }

        return $userEntity;
    }

    public function toDomain(UserEntity $userEntity): User
    {
        $user = User::create(
            new UserId($userEntity->getId()),
            $userEntity->getEmail(), 
            $userEntity->getPassword(),
            $userEntity->getRoles(),
            $userEntity->isActive()
        );

        return $user;
    }
}
