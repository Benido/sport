<?php

namespace App\DataFixtures;

//require_once 'vendor/autoload.php';

use Faker;
use App\Entity\Admin;
use App\Entity\Client;
use App\Entity\Manager;
use App\Entity\Partenaire;
use App\Entity\Structure;
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

    //The sample perms that will be added to the Structure classes

    public function load(ObjectManager $manager): void
    {
        //Set up the random data generator
        $faker = Faker\Factory::create();

        //Creates an Admin
        $admin = new Admin();
        $admin->setEmail('admin@test.com');
        $admin->setRoles(["ROLE_ADMIN"]);
        $password = $this->hasher->hashPassword($admin, 'password');
        $admin->setPassword($password);
        $manager->persist($admin);

        //Creates 3 Partenaires and stores them to generate Client accounts
        $partenaires = [];
        for ($i = 1; $i < 4; $i++) {
            $partenaire = new Partenaire();
            $partenaire->setFranchiseName('Partenaire ' . $i);
            $partenaire->setActive(mt_rand(0, 1));
            $partenaire->setPermissions(json_encode($this->randomPerm()));
            $partenaire->setShortDescription($faker->sentence());
            $partenaire->setLongDescription($faker->paragraph());
            $manager->persist($partenaire);
            $partenaires[] = $partenaire;
        }


        //Creates 3 Clients,  one for each client previously created
        foreach ($partenaires as $i => $partenaire) {
            $client = new Client();
            $client->setEmail('client' . $i + 1 . '@test.com');
            $client->setRoles(["ROLE_CLIENT"]);
            $password = $this->hasher->hashPassword($client, 'password' . $i + 1);
            $client->setPassword($password);
            $client->setPartenaire($partenaire);
            $manager->persist($client);
            $clients[] = $client;
        }

        //Creates 15 Structures with random permissions
        $indexTable = [0, 1, 2, 0, 1, 2, 0, 1, 2, 0, 1, 2, 0, 1, 2];
        $structures = [];

        for ($i = 0; $i < 15; $i++) {
            $structure = new Structure();
            $structure->setAddress($faker->streetAddress());
            $structure->setPostalCode($i * 1000 + 9000);
            $structure->setCity($i + 1 . ' test-City');
            $structure->setActive(mt_rand(0, 1));
            $structure->setPermissions(json_encode($this->randomPerm()));
            $structure->setPartenaire($partenaires[$indexTable[$i]]);
            $manager->persist($structure);
            $structures[] = $structure;
        }

        //Creates one Manager account for each Structure
        foreach ($structures as $i => $structure) {
            $mgr = new Manager();
            $mgr->setEmail('manager' . $i + 1 .'@test.com');
            $mgr->setRoles(["ROLE_MANAGER"]);
            $password = $this->hasher->hashPassword($mgr, 'password' . $i + 1);
            $mgr->setPassword($password);
            $mgr->setStructure($structure);
            $manager->persist($mgr);
        }

        $manager->flush();
    }

    public function randomPerm (): array
    {
        return [
            "members_read"=> mt_rand(0, 1),
            "members_write"=> mt_rand(0, 1),
            "members_add"=> mt_rand(0, 1),
            "members_products_add"=> mt_rand(0, 1),
            "members_payment_schedules"=> mt_rand(0, 1),
            "members_subscription_read"=> mt_rand(0, 1),
            "payment_day_read"=> mt_rand(0, 1),
            "members_statistics_read"=> mt_rand(0, 1),
            "payment_schedules_read"=> mt_rand(0, 1),
            "payment_schedules_write"=> mt_rand(0, 1)
        ];
    }
}
