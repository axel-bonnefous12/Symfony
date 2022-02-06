<?php

namespace App\DataFixtures;

use App\Entity\Rooms;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordHasherInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager): void
    {

        $user1 = new User();
        $user1->setEmail('axel@hotmail.fr')
              ->setPassword($this->passwordEncoder->hashPassword($user1, '123'))
              ->setFirstName('Axel')
               ->setLastName('Bonnefous')
               ->setRoles(array(User::ROLE_USER));
        $manager->persist($user1);

        $user2 = new User();
        $user2->setEmail('admin@hotmail.fr')
            ->setPassword($this->passwordEncoder->hashPassword($user2, '123'))
            ->setFirstName('Axel')
            ->setLastName('Bonnefous')
            ->setRoles(array(User::ROLE_ADMIN));
        $manager->persist($user2);

        $manager->flush();
    }
}
