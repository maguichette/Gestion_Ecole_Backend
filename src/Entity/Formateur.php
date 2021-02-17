<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
 *      "path":"/formateurs/{id}",
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
    /**
     * @ORM\ManyToMany(targetEntity=Groupe::class, mappedBy="formateurs")
     */
    private $groupes;

    public function __construct()
    {
        $this->groupes = new ArrayCollection();
    }

    /**
     * @return Collection|Groupe[]
     */
    public function getGroupes(): Collection
    {
        return $this->groupes;
    }

    public function addGroupe(Groupe $groupe): self
    {
        if (!$this->groupes->contains($groupe)) {
            $this->groupes[] = $groupe;
            $groupe->addFormateur($this);
        }

        return $this;
    }

    public function removeGroupe(Groupe $groupe): self
    {
        if ($this->groupes->removeElement($groupe)) {
            $groupe->removeFormateur($this);
        }

        return $this;
    }
}
