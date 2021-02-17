<?php
namespace App\DataPersister;
use App\Entity\User;
use App\Repository\UserRepository;
use App\DataPersister\UserPersiste;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;

final class UserPersiste implements ContextAwareDataPersisterInterface
{
    private $em;
    private $user;
    public function __construct(EntityManagerInterface $em, UserRepository $user){
       
        $this->manager=$em;  
        $this->user=$user;  
    }
    public function supports($data, array $context = []): bool
    {
        return $data instanceof User;
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
        //  dd('sdfgerty"');
      // call your persistence layer to delete $data
      $data->setArchive(1);
      
      
     
     
      $this->manager->persist($data);
      $this->manager->flush();
    }
}
