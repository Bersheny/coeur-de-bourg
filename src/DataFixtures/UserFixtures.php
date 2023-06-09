<?php

namespace App\DataFixtures;

use App\Entity\TblUsers;
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
        $superAdmin = new TblUsers();
        $superAdmin->setEmail('coeurdebourg@admin.fr');

        $plaintextPassword = "superadmin";
        $hashedPassword = $this->passwordHasher->hashPassword(
            $superAdmin,
            $plaintextPassword
        );
        $superAdmin->setPassword($hashedPassword);
        $superAdmin->setRoles([
            "ROLE_SUPER_ADMIN",
        ]);
        
        $superAdmin->setFirstName('coeurdebourg');
        $superAdmin->setLastName('admin');

        $manager->persist($superAdmin);

        $manager->flush();
    }
}
