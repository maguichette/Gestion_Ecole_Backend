<?php
namespace App\DataPersister;
use App\Entity\Profil;
use App\DataPersister\Persiste;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;

final class Persiste implements ContextAwareDataPersisterInterface
{
    private $em;
    private $user;
    public function __construct(EntityManagerInterface $em, UserRepository $user){
       
        $this->manager=$em;  
        $this->user=$user;  
    }
    public function supports($data, array $context = []): bool
    {
        return $data instanceof Profil;
    }

    public function persist($data, array $context = [])
    {
      // call your persistence layer to save $data
      $data->setLibelle($data->getLibelle());
      $this->manager->persist($data);
      $this->manager->flush();
      return $data;
    }

    public function remove($data, array $context = [])
    {
        // dd('sdfgerty"');
      // call your persistence layer to delete $data
      $data->setStatut(1);
      
      
     
      foreach ($data->getUsers() as $value) {
        $value->setArchive(1);
        $this->manager->persist($value);
        $this->manager->flush();
      }
      $this->manager->persist($data);
      $this->manager->flush();
    }
}
