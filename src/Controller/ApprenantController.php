<?php

namespace App\Controller;

use App\Entity\Apprenant;
use App\Services\PutService;
use App\Services\UserService;
use App\Repository\ApprenantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ApprenantController extends AbstractController
{
    private $apprenant;
    public function __construct(SerializerInterface $serializer, EntityManagerInterface $em, ValidatorInterface $validator, UserPasswordEncoderInterface $encoder )
    {
        $this->serialize = $serializer ;
        $this->validator = $validator ;
        $this->encoder = $encoder ;
        $this->em = $em ;
    }
    /**
     * @Route(
     *      name="create_apprenant",
     *      path="api/apprenants",
     *      methods={"POST"},
     * defaults={
     *      "__api_resource_class"=Apprenant::class,
     *      "__api_collection_operation_name"="create_apprenant"
     * }
     * )
     */
    
    public function create_apprenant(SerializerInterface $serializer,UserService $service, Request $request, EntityManagerInterface $em)
    {
        $user=$service->addUser($request,'APPRENANT');
            $em->persist($user);
            $em->flush();
            return new JsonResponse("SUCCES",200,[],true);
    }
    /**
     * @Route(
     *      name="modifier_apprenant",
     *      path="/api/apprenants/{id}",
     *      methods={"PUT"},
     * defaults={
     *      "__api_resource_class"="Apprenant::class",
     *      "__api_item_operetion_name"="modif_apprenant",
     *      "__controller"="app/controller/UserController::modif_apprenant",
     * }
     * )
     */
    public function modif_apprenant($id,PutService $service,Request $request, ApprenantRepository $repo, EntityManagerInterface $em, UserPasswordEncoderInterface $encoder){
      
        $utilisateurs=$repo->find($id);
        // dd($utilisateurs);
          $user=$service->PutUser($request,'avatar');
       
        $em->persist($utilisateurs);
        $em->flush();
        return new JsonResponse("SUCCES",200,[],true);
        }
        
}