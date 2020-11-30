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
        $admin->setEmail($faker->email());
        $admin->setPrenom($faker->firstNa);
        $admin->setNom($faker->nom());
        $admin->setAdresse($faker->adresse());
        $admin->setTelephone($faker->telephone());
        $admin->setArchive(0);
        $admin->setPRofil($this->getReference(AdminFixtures::ADMIN_REFERENCE));
        $admin->setPassword;
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
