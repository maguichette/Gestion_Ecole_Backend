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

           
            $groupe->setNom('COHORTE 3 DEV WEB')
                    ->setStatut("statut principale")
                    ->setDateCreation(new \DateTime())
                    ->setType('GROUPE PRINCIPALE');
    
             // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
        }
       
    }

