<?php

namespace App\DataFixtures;

use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class AdminFixtures  extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        $admin=new Admin();
        $a->setEmail($faker->email());
        $a->setPrenom($faker->prenom());
        $a->setNom($faker->nom());
        $a->setAdresse($faker->adresse());
        $a->setTelephone($faker->telephone());
        $manager->persist($profiles);

        $manager->flush();
    }
    public function getDependencies()
    {
        return array(
            UserFixtures::class,
        );
    }
}
