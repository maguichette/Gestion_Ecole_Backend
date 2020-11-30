<?php

namespace App\Entity;

use Faker\Factory;
use App\Repository\CMRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CMRepository::class)
 */
class CM extends User
public function load(ObjectManager $manager)
{
    $faker = Factory::create('fr_FR');
    $Cm=new CM();
    $Cm->setEmail($faker->email());
    $Cm->setPrenom($faker->firstName());
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
