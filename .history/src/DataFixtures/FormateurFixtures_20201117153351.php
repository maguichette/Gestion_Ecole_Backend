<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Formateur;
use App\DataFixtures\UserFixtures;
use App\DataFixtures\ProfilFixtures;
use App\DataFixtures\FormateurFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class FormateurFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        $Fm=new Formateur();
        $Fm->setEmail($faker->email());
        $Fm->setPrenom($faker->firstName());
        $Fm->setNom($faker->lastName);
        $App->setTelephone($faker->PhoneNumber);
        $App->setAdresse($faker->city);
        $Fm->setArchive(0);
        $Fm->setPRofil($this->getReference(ProfilFixtures::FORMATEUR_REFERENCE));
        $Fm->setPassword(122);
        $manager->persist($Fm);
    
        $manager->flush();
    }
    public function getDependencies()
    {
        return array(
            UserFixtures::class,
        ); 
    }
}
