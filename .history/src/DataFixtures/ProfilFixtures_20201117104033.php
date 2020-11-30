<?php

namespace App\DataFixtures;

use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\HttpKernel\Profiler\Profile;

class ProfilFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $profil= ['Formateur','CM','Aprenant','Admin'];
        
        for($i=0;$i<4 ;$i++){

            $profiles=new Profile();
            $profiles->setlibele($profil[$i]);
            $this->addReference($i,$profiles);
            $manager->persist($profiles);


       }
        $manager->flush();

        $manager->flush();
    }
}
