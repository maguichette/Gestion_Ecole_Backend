<?php
namespace App\Services;

use App\Repository\ProfilRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class PutService
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

    
    public function __construct(SerializerInterface $serializer, EntityManagerInterface $em, ValidatorInterface $validator, UserPasswordEncoderInterface $encoder,ProfilRepository $repo )
    {
        $this->serialize = $serializer ;
        $this->validator = $validator ;
        $this->encoder = $encoder ;
        $this->em = $em ;
        $this->profilRepository = $repo ;
    }
/**
     * put image of user
     * @param Request $request
     * @param string|null $fileName
     * @return array
     * 
     */


    public function PutUser(Request $request,string $fileName = null){
        $raw =$request->getContent();

    //    dd($raw);
        $delimiteur = "multipart/form-data; boundary=";
        $boundary= "--" . explode($delimiteur,$request->headers->get("content-type"))[1];
        $elements = str_replace([$boundary,'Content-Disposition: form-data;',"name="],"",$raw);
        // dd($elements);
        $elementsTab = explode("\r\n\r\n",$elements);
        // dd($elementsTab);
        $data =[];
        for ($i=0;isset($elementsTab[$i+1]);$i+=2){
            // dd($elementsTab[$i+1]);
            $key = str_replace(["\r\n",' "','"'],'',$elementsTab[$i]);
            // dd($key);
            if (strchr($key,$fileName)){
                $stream =fopen('php://memory','r+');
                // dd($stream);
                fwrite($stream,$elementsTab[$i +1]);
                rewind($stream);
                $data[$fileName] = $stream;
                // dd($data);
            }else{
                $val=$elementsTab[$i+1];
                $val = str_replace(["\r\n", "--"],'',($elementsTab[$i+1]));
                //dd($val);
                $data[$key] = $val;
               // dd($data[$key]);
            }
        }
            //dd($data);
            // dd($data["profil"]);
            if (isset($data["profil"])) {
                $prof=$this->profilRepository->findOneBy(['libelle'=>$data["profil"]]);
                $data["profil"] = $prof;
            }
       
        // dd($prof);
        return $data;

    }
    
}


?>