<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ApprenantFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
{
    $faker = Factory::create('fr_FR');
    $Cm=new CM();
    $Cm->setEmail($faker->email());
    $Cm->setPrenom($faker->firstName());
    $Cm->setNom($faker->lastName);
    $Cm->setNom($faker->lastName);
    $Cm->setArchive(0);
    $Cm->setPRofil($this->getReference(ProfilFixtures::CM_REFERENCE));
    $Cm->setPassword(122);
    $manager->persist($Cm);

    $manager->flush();
}
public function getDependencies()
{
    return array(
        UserFixtures::class,
    ); 
}
}
