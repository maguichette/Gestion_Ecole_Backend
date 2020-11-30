<?php

namespace App\Entity;

use App\Entity\Apprenant;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ApprenantRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ApprenantRepository::class)
 * @ApiResource(
 * attributes={
 *      "pagination_enabled"=true,
 *      "security" = "is_granted('ROLE_Admin') or is_granted('ROLE_Formateur') or is_granted('ROLE_CM')",
 *      "security_message" = "vous n'avez pas accès",
 *   },
 * collectionOperations={ 
 *    "get":{
 *      "path":"/apprenants",
 * },
 * "create_apprenant"={
 *          "method"= "POST",
 *          "path" = "/apprenants",
 *          "route_name"="create_apprenant",
 *   },
 * },
 * itemOperations={
 *  "get"={
 *      "path"="/api/apprenants/{id}",
 *  },
 *  "modif_apprenant"={
 *     "route_name"="modifier_apprenant",
*      "path"="/api/apprenants/{id}",
 *      "methods"={"PUT"},
 * 
 * },
 * }, 
 * )
 */
class Apprenant extends User
{
   

}
