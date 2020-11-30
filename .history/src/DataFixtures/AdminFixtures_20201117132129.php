<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Admin;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class AdminFixtures  extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        $admin=new Admin();
        $ad->setEmail($faker->email());
        $ad->setPrenom($faker->prenom());
        $ad->setNom($faker->nom());
        $ad->setAdresse($faker->adresse());
        $ad->setTelephone($faker->telephone());
        $ad->setArchive(0);
        $ad->setPRofil($this->getReference(AdminFixtures::ADMIN_REFERENCE));
        $ad->setPassword;
        $manager->persist($user);

        $manager->flush();
    }
    public function getDependencies()
    {
        return array(
            UserFixtures::class,
        );
    }
}
