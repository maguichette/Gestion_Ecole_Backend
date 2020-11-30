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
        $FRew FORMATEUR();
        $FRsetEmail($faker->email());
        $FRsetPrenom($faker->firstName());
        $FRsetNom($faker->lastName);
        $FRsetArchive(0);
        $FRsetPRofil($this->getReference(ProfilFixtures::FREFERENCE));
        $FRsetPassword(122);
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
