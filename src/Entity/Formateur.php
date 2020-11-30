<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\FormateurRepository;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=FormateurRepository::class)
 *  @ApiResource(
 * attributes={
 *      "pagination_enabled"=true,
 *   },
 * collectionOperations={ 
 *  "get":{
 *      
 *      "path":"/formateurs",
 *      "normalization_context"={"groups"={"user:read"}},
 *      "security" = "is_granted('ROLE_Admin') or is_granted('ROLE_CM')",
 *      "security_message" = "vous n'avez pas accès",
 * },
 *  },
 *  itemOperations={ 
 *    "get":{
 *      "path":"/formateurs/id",
 *      "security" = "is_granted('ROLE_Admin') or is_granted('ROLE_Formateur')or is_granted('ROLE_CM')",
 *      "security_message" = "vous n'avez pas accès",
 *      
 * },
 *  
 * }
 * )
 */
class Formateur extends User
{
   
}
