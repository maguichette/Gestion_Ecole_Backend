<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class Profil extends Fixture
{
    public function load(ObjectManager $manager)
    {
       $profiles= ['Formateur','CM','Aprenant','a']
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
