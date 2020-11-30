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
        $FRnew FORMATEUR();
        $FR>setEmail($faker->email());
        $FR>setPrenom($faker->firstName());
        $FR>setNom($faker->lastName);
        $FR>setArchive(0);
        $FR>setPRofil($this->getReference(ProfilFixtures::FRREFERENCE));
        $FR>setPassword(122);
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
