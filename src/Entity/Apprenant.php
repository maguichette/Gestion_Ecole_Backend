<?php

namespace App\Entity;

use App\Entity\Apprenant;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
 *    "get"={
 *      "path"="/apprenants",
 * },
 * "create_apprenant"={
 *          "method"= "POST",
 *          "path" = "/apprenants",
 *          "route_name"="create_apprenant",
 *   },
 * },
 * itemOperations={
 *  "get"={
 *      "path"="/apprenants/{id}",
 *  },
 *  "modif_apprenant"={
 *     "route_name"="modifier_apprenant",
*      "path"="/apprenants/{id}",
 *      "methods"={"PUT"},
 * 
 * },
 * }, 
 * )
 */
class Apprenant extends User
{
    

   

    /**
     * @ORM\ManyToMany(targetEntity=Groupe::class, mappedBy="apprenants")
     * @Groups({"promo:write"})
     */
    private $groupes;

    /**
     * @ORM\Column(type="boolean")
     */
    private $attente;

    /**
     * @ORM\ManyToOne(targetEntity=ProfilSortie::class, inversedBy="apprenants")
     */
    private $profilSortie;

    public function __construct()
    {
       
        $this->promos = new ArrayCollection();
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
            $groupe->addApprenant($this);
        }

        return $this;
    }

    public function removeGroupe(Groupe $groupe): self
    {
        if ($this->groupes->removeElement($groupe)) {
            $groupe->removeApprenant($this);
        }

        return $this;
    }

    public function getAttente(): ?bool
    {
        return $this->attente;
    }

    public function setAttente(bool $attente): self
    {
        $this->attente = $attente;

        return $this;
    }

    public function getProfilSortie(): ?ProfilSortie
    {
        return $this->profilSortie;
    }

    public function setProfilSortie(?ProfilSortie $profilSortie): self
    {
        $this->profilSortie = $profilSortie;

        return $this;
    }

    
    }

    
    

  
