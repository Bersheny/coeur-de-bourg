<?php

namespace App\DataFixtures;

use App\Entity\CdbUsers;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\DBAL\Driver\IBMDB2\Exception\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher) {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        /* Utilisateur temporaire, À SUPPRIMER */
        $adminTemp = new CdbUsers();
        $adminTemp->setFirstName('Admin-Temporaire');
        $adminTemp->setLastName('À-Supprimer');
        $adminTemp->setEmail('admintemporaire@asupprimer.fr');
        $plaintextPassword = "admintempcdb";
        $hashedPassword = $this->passwordHasher->hashPassword(
            $adminTemp,
            $plaintextPassword
        );
        $adminTemp->setPassword($hashedPassword);
        $adminTemp->setRoles([
            "ROLE_ADMIN",
        ]);
        $manager->persist($adminTemp);
        $manager->flush();
    }
}