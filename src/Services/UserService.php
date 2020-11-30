<?php
namespace App\Services;

use App\Entity\CM;
use App\Entity\Admin;
use App\Entity\Apprenant;
use App\Entity\Formateur;
use App\Repository\ProfilRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserService

{
/**
     * @var SerializerInterface
     */
    private $serialize;
    /**
     * @var ValidatorInterface
     */
    private $validator;
    private $encoder;
    /**
     * @var EntityManagerInterface
     */
    private $manager;

    /**
     * PostController constructor.
     */
    public function __construct(ProfilRepository $profilrepository, DenormalizerInterface $serializer, EntityManagerInterface $em, ValidatorInterface $validator, UserPasswordEncoderInterface $encoder )
    {
        $this->serializer = $serializer ;
        $this->validator = $validator ;
        $this->encoder = $encoder ;
        $this->em = $em ;
        $this->profilRepository = $profilrepository;
    }
    public function addUser(Request $request,$profil)
    {

         $user = $request->request->all();
        //  dd($user);
         $photo = $request->files->get('avatar');
        if($photo){
            $file = $photo->getRealPath();
            $avatar = fopen($file,'r+');
            $user['avatar']=$avatar;
        }
        //  dd($user);
        //  dd($profil); 
        //  $users = new User;
        $userType="";
        if($user['profil'] == "Admin"){
            $userType = Admin::class;
        }elseif ($user['profil'] == "Cm") {
            $userType = CM::class;        
        }elseif ($user['profil'] == "Formateur") {
            $userType = Formateur::class;       
         }elseif ($user['profil'] == "Apprenant") {
            $userType = Apprenant::class;     
                           
        }
        $idProfil = $this->profilRepository->findOneBy(['libelle' => $profil])->getId();
        $user['profil'] = "/api/admin/profils/".$idProfil;           
        $users = $this->serializer->denormalize($user,$userType);
        // dd($users);
        //encode password
        $errors = $this->validator->validate($users); 
        if (count($errors)>0){
            // dd($errors);
            return ($errors);
        }
        $users->setPassword($this->encoder->encodePassword($users,$user['password']));
        $users->setProfil($this->profilRepository->findOneBy(['libelle'=>$profil])); 
        // dd($users);
        return $users ;
        }

}
