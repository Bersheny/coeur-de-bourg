<?php

namespace App\DataFixtures;

use App\Entity\CdbUsers;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $adminTemp = new CdbUsers();
        $adminTemp->setFirstName('Admin');
        $adminTemp->setLastName('CDB');
        $adminTemp->setEmail('admin@cdb.fr');
        $adminTemp->setPassword("$2y$13$/gQxBtjk1PqPpAYWdvztv.gxL6qFDAxovfOpCgUuYtl9AZPcnQ2Ea");
        $adminTemp->setRoles([
            "ROLE_ADMIN",
        ]);
        $manager->persist($adminTemp);
        $manager->flush();
    }
}