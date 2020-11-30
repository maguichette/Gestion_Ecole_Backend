<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AdminFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        $admin=new Admin();
        $user->setEmail($faker->email());
        $user->setPrenom($faker->prenom());
        $user->setNom($faker->nom());
        $user->setAdresse($faker->adresse());
        $user->setTelephone($faker->telephone());
        $user->setprofiles($this->getReference($i));

        $manager->flush();
    }
}
