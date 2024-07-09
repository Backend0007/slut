<?php

namespace App\DataFixtures;

use App\Entity\User;
use Symfony\Component\Uid\Uuid;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager)
    {
        $admin = new User();
        $admin->setIdUser(Uuid::v4());
        $admin->setEmail('admin@slut.com');    
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setUsername('Admin');
        $admin->setFirstName('Administrateur');
        $admin->setLastName('Administarteur');
        $admin->setPrivilege('Administrateur');
        $admin->setPhoto('avatar-3.png');
        $admin->setConditions('on');
        $admin->setAgency('Kinshasa');
        $admin->setProvince('Kinshasa');

        $hashedPassword = $this->passwordHasher->hashPassword(
            $admin,
            '00000'
        );
        $admin->setPassword($hashedPassword);

        $manager->persist($admin);
        $manager->flush();
    }
}

