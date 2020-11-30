<?php

namespace App\Entity;

use Faker\Factory;
use App\Repository\CMRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CMRepository::class)
 */
class CM extends User
{
    $faker = Factory::create('fr_FR');
    $C=new C();
    $C->setEmail($faker->email());
    $C->setPrenom($faker->firstName());
    $C->setNom($faker->lastName);
    $C->setArchive(0);
    $C->setPRofil($this->getReference(ProfilFixtures::C_REFERENCE));
    $C->setPassword(122);
    $manager->persist($C);

    $manager->flush();
}
public function getDependencies()
{
    return array(
        UserFixtures::class,
    ); 
}
