<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Niveau;
use App\Entity\Competence;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CompetenceFixtures extends Fixture
{
    public static function getReferenceKey($i){
         
        return sprintf('competences_%s',$i);
    }
    public function load(ObjectManager $manager)
    {
        $fake = Factory::create('fr-FR');

        for ($i=1;$i<=13;$i++){
            $competence=new Competence();
            $competence->setLibelle('libelle_'.$i)
                ->setDescripton($fake->text);
            

            for ($n=1;$n<=3;$n++){

                $niveau=new Niveau();
                $niveau->setLibelle('niveau_'.$n)
                    ->setCritereEvaluation('CRITERE '.$fake->realText())
                    ->setGroupeActions('GROUPE ACTION'.$fake->realText());
                    
                $manager->persist($niveau);
                $competence->addNiveau($niveau);
            }
            $this->addReference(self::getReferenceKey($i),$competence);
        // dd($competence);

            $manager->persist($competence);
        }
        $manager->flush();
    }
}
