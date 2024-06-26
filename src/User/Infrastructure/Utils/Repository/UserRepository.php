<?php

declare(strict_types=1);

namespace App\User\Infrastructure\Utils\Repository;

use App\User\Domain\Exception\UserNotFoundException;
use App\User\Domain\Model\User;
use App\User\Domain\Model\UserId;
use App\User\Domain\Repository\UserRepositoryInterface;
use App\User\Infrastructure\Repository\UserRepository as DoctrineUserRepository;
use App\User\Infrastructure\Utils\Transformer\UserTransformer;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(
        private DoctrineUserRepository $repository,
        private UserTransformer $transformer
    ) {  
    }

    public function save(User $user): void
    {
        $this->repository->save(
            $this->transformer->fromDomain($user)
        );
    }

    public function get(UserId $id): User
    {
        $user = $this->repository->find($id->toString());

        return $user === null 
            ? throw new UserNotFoundException()
            : $this->transformer->toDomain($user);
    }
}