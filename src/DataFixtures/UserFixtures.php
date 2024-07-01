<?php

namespace App\DataFixtures;

use App\Shared\Application\Service\IdGeneratorInterface;
use App\User\Domain\Model\User;
use App\User\Domain\Model\UserId;
use App\User\Domain\Repository\UserRepositoryInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{

    public function __construct(
        private IdGeneratorInterface $idGenerator,
        private UserPasswordHasherInterface $userPasswordHasher,
        private UserRepositoryInterface $userRepository
    ) {  
    }

    public function load(ObjectManager $manager): void
    {
        $admin = new User(
            new UserId($this->idGenerator->generate()->toString()),
            'poczta@sebastianpluta.pl',
            'tmpPassword',
            ['ROLE_ADMIN']
        );

        $admin->setPassword($this->userPasswordHasher->hashPassword($admin, 'wrz4jk94'));

        $this->userRepository->save($admin);
        
    }
}
