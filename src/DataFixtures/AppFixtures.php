<?php

namespace App\DataFixtures;

use App\Entity\Login;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }


    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('user@jon.se');
        $user->setPassword($this->passwordHasher->hashPassword($user, 'asdf123'));
        $manager->persist($user);

        $user = new User();
        $user->setEmail('jon@jon.se');
        $user->setPassword($this->passwordHasher->hashPassword($user, 'asdf123'));
        $user->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);

        foreach (range(1, 10) as $i) {
            $login = new Login($user, new \DateTimeImmutable('-' . $i . ' days'));
            $manager->persist($login);
        }

        $manager->flush();
    }
}
