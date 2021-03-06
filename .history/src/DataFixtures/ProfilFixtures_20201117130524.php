<?php

namespace App\DataFixtures;

use App\Entity\Profil;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\HttpKernel\Profiler\Profile;

class ProfilFixtures extends Fixture
{
    public const ADMIN_REFERENCE = 'ADMIN';
    public const FORMATEUR_REFERENCE = 'FORMATEUR';
    public const APPRENANT_REFERENCE = 'APPRENANT';
    public const CM_REFERENCE = 'CM';
    
    public function load(ObjectManager $manager)
    {
        
        $profil= ['Formateur','CM','Aprenant','Admin'];
        
        for($i=0;$i< count($profil) ;$i++){

            $profiles=new Profil();
            $profiles->setLibelle($profil[$i]);
            if($profil[$i=='Admin']){
                $this->addReference(self::ADMIN_REFERENCE, $profiles);
            }
            elseif ($profil[$i==4) {
                # code...
            }
            
            $manager->persist($profiles);


       }
        $manager->flush();

        
    }
}
