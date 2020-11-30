<?php

namespace App\DataFixtures;

use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class User extends Fixture
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

            }
            $user=new User();
            $user->setEmail($faker->email());
            $user->setprenom($faker->prenom());
            $user->setNom($faker->nom());
            $user->setNom($faker->nom());
    
             // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
        }
       
    }

