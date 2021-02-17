<?php
namespace App\DataPersister;
use App\Entity\BlogPost;

use App\Entity\Competence;
use App\Entity\GroupeCompetence;
use Doctrine\ORM\EntityManagerInterface;
use App\DataPersister\GroupecopetencePersiste;
use Symfony\Component\HttpFoundation\RequestStack;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;

final class GroupecopetencePersiste implements ContextAwareDataPersisterInterface
{
  private $request;
  private $em;
  public function __construct(EntityManagerInterface $em, RequestStack $request){
    $this->request=$request; 
    $this->em=$em; 
  }
    public function supports($data, array $context = []): bool
    {
        return $data instanceof GroupeCompetence;
    }

    public function persist($data, array $context = [])
    {
      // call your persistence layer to save $data
     if (isset($context['item_operation_name'])) {
      // dd($data);
      $contain=$this->request->getCurrentRequest();
      // dd($contain);
      $containdecode=json_decode($contain->getContent(),true);
       //dd($containdecode);
      foreach ($containdecode['competence'] as $key => $value) {
        $idcomp=$this->em->getRepository(Competence::class)->find($value["id"]);
        // dd($idcomp);
        if (isset($value['option']) and $value['option']=="add") {
          $data->addCompetence( $idcomp);
          $this->em->persist($idcomp);
     
        }
        elseif (isset($value['option']) and $value['option']=="sup") {
          $data->removeCompetence( $idcomp);
        }

      }
     }
     $this->em->flush();

    }

    public function remove($data, array $context = [])
    {
      // call your persistence layer to delete $data
    }
}