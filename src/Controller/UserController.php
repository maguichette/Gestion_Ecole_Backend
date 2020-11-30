<?php

namespace App\Controller;

use App\Entity\User;
use App\Services\PutService;
use App\Services\UserService;
use App\Controller\UserController;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{

    /**
     * @Route(
     *      name="create_user",
     *      path="/api/admin/users",
     *      methods={"POST"},
     * defaults={
     *      "__api_resource_class"=User::class,
     *      "__api_collection_operation_name"="create_users"
     * }
     * )
     */
    public function addUser(DenormalizerInterface $serializer,UserService $service, Request $request, EntityManagerInterface $em)
    {
         
       $profil = $request->request->get("profil");
        
       $user=$service->addUser($request,$profil);
       if(!($user instanceof User)){ 
            return $this->json($user,400);
        }
           $em->persist($user);
            $em->flush();
            return new JsonResponse("SUCCES",200,[],true);
        
       
        
        
    }
  /**
     * @Route(
     *      name="modifier_user",
     *      path="/api/admin/users/{id}",
     *      methods={"PUT"},
     * defaults={
     *      "__api_resource_class"="User::class",
     *      "__api_item_operetion_name"="modif_user",
     *      "__controller"="app/controller/UserController::modif_user",
     * }
     * )
     */
    public function modif_user($id,PutService $service,Request $request, UserRepository $repo, EntityManagerInterface $em, UserPasswordEncoderInterface $encoder){
        $user=$service->PutUser($request,'avatar');
        // dd($user);
        $utilisateurs=$repo->find($id);
      
        // dd($utilisateurs);
        foreach ($user as $key => $valeur) {
            $setter='set'.ucfirst(strtolower($key));
            // dd($setter);
            if(method_exists(User::class, $setter)){
                if($setter=='setProfil'){
                    $utilisateurs->setProfil($user["profil"]);
                }
                else{
                    // dd($valeur);
                    $utilisateurs->$setter($valeur);
                }

            }
            if ($setter=='setPassword'){
                // dd($encoder);
                $utilisateurs->setPassword($encoder->encodePassword($utilisateurs,$user['password']));
                // dd($encoder);

            }
        }
        //dd($utilisateur);
        $em->persist($utilisateurs);
        $em->flush();
        return new JsonResponse("SUCCES",200,[],true);
        }
        
    }
