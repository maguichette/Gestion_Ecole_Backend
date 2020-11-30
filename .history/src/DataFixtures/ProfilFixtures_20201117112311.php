<?php

namespace App\DataFixtures;

use App\Entity\Profil;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\HttpKernel\Profiler\Profile;

class ProfilFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        public const USER_REFERENCE = 'user-gary';
        $profil= ['Formateur','CM','Aprenant','Admin'];
        
        for($i=0;$i< ;$i++){

            $profiles=new Profil();
            $profiles->setLibelle($profil[$i]);
            $this->addReference($i,$profiles);
            $manager->persist($profiles);


       }
        $manager->flush();

        $manager->flush();
    }
}
