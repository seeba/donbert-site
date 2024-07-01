<?php

declare(strict_types=1);

namespace App\User\Infrastructure\Security;

use App\User\Domain\Exception\UserNotFoundException;
use App\User\Domain\Model\User;
use App\User\Domain\Repository\UserRepositoryInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserProvider implements UserProviderInterface
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {     
    }

    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        return $this->userRepository->findUserByEmail($identifier);
    }

    public function refreshUser(UserInterface $user): UserInterface
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instancja "%s" nie jest wspierana.', get_class($user)));
        }

        $userId = $user->getId();
        $refreshedUser = $this->userRepository->findById($userId);

        if (null === $refreshedUser) {
            throw new UserNotFoundException(sprintf('Użytkownik o ID "%d" nie może być przeładowany', $userId));
        }

        return $refreshedUser;
    }

    public function supportsClass(string $class): bool
    {
        return User::class === $class;
    }
}
