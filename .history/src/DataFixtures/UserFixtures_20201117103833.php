<?php

namespace App\DataFixtures;

use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
        public function load(ObjectManager $manager)
        {
            $faker = Factory::create('fr_FR');

            for($i=0;$i<4 ;$i++){
                $user=new User();
            $user->setEmail($faker->email());
            $user->setPrenom($faker->prenom());
            $user->setNom($faker->nom());
            $user->setAdresse($faker->adresse());
            $user->setTelephone($faker->telephone());
            $user->setprofiles($this->getReference($i));
    
             
        $manager->persist($product);


            }
            
        $manager->flush();
        }
}
