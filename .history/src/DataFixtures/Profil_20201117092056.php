<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class Profil extends Fixture
{
    public function load(ObjectManager $manager)
    {
       $profil= ['Formateur','CM','Aprenant','Admin']
       for($i=0,$i=4,$i++){
           $profiles=new pro

       }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
