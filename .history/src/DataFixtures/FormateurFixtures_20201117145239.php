<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\DataFixtures\FormateurFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class FormateurFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        $F=new FORMATEUR();
        $F->setEmail($faker->email());
        $F->setPrenom($faker->firstName());
        $F->setNom($faker->lastName);
        $F->setArchive(0);
        $F->setPRofil($this->getReference(ProfilFixtures::F_REFERENCE));
        $F->setPassword(122);
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
