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
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class FormateurFixtures extends Fixture implements DependentFixtureInterface
{
     
    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        $Fm=new Formateur();
        $encode=$this->encoder->encodePassword($Fm,'passer');
        $Fm->setEmail($faker->email());
        $Fm->setPrenom($faker->firstName());
        $Fm->setNom($faker->lastName);
        $Fm->setTelephone($faker->PhoneNumber);
        $Fm->setAdresse($faker->city);
        $Fm->setArchive(0);
        $Fm->setPRofil($this->getReference(ProfilFixtures::FORMATEUR_REFERENCE));
        $Fm->setPassword($encode);
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
