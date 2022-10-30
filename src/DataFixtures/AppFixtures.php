<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Entity\Client;
use App\Entity\Manager;
use App\Entity\Partenaire;
use App\Entity\Structure;
use App\Entity\Branch;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        //Creates two types of user
        $admin = new Admin();
        $admin->setEmail('admin@test.com');
        $admin->setRoles(["ROLE_USER"]);
        $password = $this->hasher->hashPassword($admin, 'password');
        $admin->setPassword($password);
        $manager->persist($admin);

        $client = new Client();
        $client->setEmail('client@test.com');
        $client->setRoles(["ROLE_CLIENT"]);
        $password = $this->hasher->hashPassword($client, 'password');
        $client->setPassword($password);
        $manager->persist($client);

        //Creates 6 Partenaires

        $partenaires = [];
        for ($i = 1; $i < 7; $i++) {
            $partenaire = new Partenaire();
            $partenaire->setClientName('Partenaire ' . $i);
            $partenaire->setActive(mt_rand(0, 1));
            $partenaire->setClient($client);
            $manager->persist($partenaire);
            //$this->addReference('Partenaire_' . $i, $partenaire);
            $partenaires[] = $partenaire;
        }

        //Get the files that contains sample permissions
        include('permsFixtures.php');
        $indexTable = [0, 1, 2, 3, 4, 5, 0, 1];
        $structures = [];
        //Creates 8 Structures
        foreach($perms as $i => $table) {
            $structure = new Structure();
            $structure->setInstallName('Structure ' . $i + 1);
            $structure->setActive(mt_rand(0,1));
            $structure->setPermissions(json_encode($table));
            $structure->setPartenaire($partenaires[$indexTable[$i]]);
            $manager->persist($structure);
            $structures[] = $structure;
            //$this->addReference('Structure_' . $i, $structure);
        }

        //Creates 12 Branches
        $branch = null;
        $iTable = [0, 1, 2, 3, 4, 5, 6, 7, 0, 1, 2, 3];
        for ($i = 0; $i < 12; $i++) {
            $branch = new Branch();
            $branch->setPostalCode($i * 1000 + 9000);
            $branch->setAddress('test-address');
            $branch->setCity($i + 1 . ' test-City');
            $branch->setActive(mt_rand(0, 1));
            $branch->setStructure($structures[$iTable[$i]]);
            $manager->persist($branch);
        }

        $mgr = new Manager();
        $mgr->setEmail('manager@test.com');
        $mgr->setRoles(["ROLE_MANAGER"]);
        $password = $this->hasher->hashPassword($mgr, 'password');
        $mgr->setPassword($password);
        $mgr->setBranch($branch);
        $manager->persist($mgr);

        $manager->flush();
    }
}