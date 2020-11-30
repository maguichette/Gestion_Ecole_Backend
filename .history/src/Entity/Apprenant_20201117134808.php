<?php

namespace App\Entity;

use Faker\Factory;
use App\Entity\Apprenant;
use Doctrine\ORM\Mapping as ORM;
use App\DataFixtures\UserFixtures;
use App\DataFixtures\ProfilFixtures;
use App\Repository\ApprenantRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

/**
 * @ORM\Entity(repositoryClass=ApprenantRepository::class)
 */
class Apprenant extends Fixture implements DependentFixtureInterface
{  
public function load(ObjectManager $manager)
{
    $faker = Factory::create('fr_FR');
    $APP=new Apprenant();
    $APP->setEmail($faker->email());
    $APP->setPrenom($faker->firstName());
    $APP->setNom($faker->lastName);
    $APP->setArchive(0);
    $APP->setPRofil($this->getReference(ProfilFixtures::APPRENANT_REFERENCE));
    $APP->setPassword(122);
    $manager->persist($APP);

    $manager->flush();
}
public function getDependencies()
{
    return array(
        UserFixtures::class,
    ); 
}
}