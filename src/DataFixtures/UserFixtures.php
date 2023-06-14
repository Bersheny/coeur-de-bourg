<?php

namespace App\DataFixtures;

use App\Entity\CdbUsers;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher) {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $superAdmin = new CdbUsers();
        $superAdmin->setEmail('coeurdebourg@admin.fr');

        $plaintextPassword = "3zMeRR3VASJ549bu";
        $hashedPassword = $this->passwordHasher->hashPassword(
            $superAdmin,
            $plaintextPassword
        );
        $superAdmin->setPassword($hashedPassword);
        $superAdmin->setRoles([
            "ROLE_ADMIN",
        ]);
        
        $superAdmin->setFirstName('coeurdebourg');
        $superAdmin->setLastName('superadmin');

        $manager->persist($superAdmin);

        $manager->flush();
    }
}
