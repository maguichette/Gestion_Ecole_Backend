<?php

namespace App\Entity;

use App\Repository\CMRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CMRepository::class)
 */
class CM extends User
{
    $faker = Factory::create('fr_FR');
    $admin=new Admin();
    $admin->setEmail($faker->email());
    $admin->setPrenom($faker->firstName());
    $admin->setNom($faker->lastName);
    $admin->setArchive(0);
    $admin->setPRofil($this->getReference(ProfilFixtures::ADMIN_REFERENCE));
    $admin->setPassword(122);
    $manager->persist($admin);

    $manager->flush();
}
public function getDependencies()
{
    return array(
        UserFixtures::class,
    ); 
}
