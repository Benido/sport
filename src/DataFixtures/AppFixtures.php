<?php

namespace App\DataFixtures;

use App\Entity\Partenaire;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 6; $i++) {
            $partenaire = new Partenaire();
            $partenaire->setClientName('Partenaire ' . $i);
            $partenaire->setActive(mt_rand(0,1));
            $manager->persist($partenaire);
            $manager->flush();
        }
    }
}
