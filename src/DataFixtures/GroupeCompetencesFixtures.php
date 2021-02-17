<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\GroupeCompetence;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\CompetenceFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\DataFixtures\GroupeCompetencesFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class GroupeCompetencesFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $fake=Factory::create('fr-FR');

        for($i=1;$i<=13;$i++){
    
            $competence[]=$this->getReference(CompetenceFixtures::getReferenceKey($i));
        }
    
        for($c=1;$c<=5;$c++){
    
            $groupeCompetence=new GroupeCompetence();
            $groupeCompetence->setLibelle($fake->realText())
            ->setDescription($fake->realText());
    
            for($m=1;$m<=4;$m++){
                
                $groupeCompetence->addCompetence($fake->unique(true)->randomElement($competence));
                $manager->persist($groupeCompetence);
            }
            
            $manager->flush();
        }
     }
    
     public function getDependencies()
     {
        return array(
             CompetenceFixtures::class,
         );
    }
}
