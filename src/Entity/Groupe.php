<?php

namespace App\Entity;

use App\Entity\Promo;
use App\Entity\Apprenant;
use App\Entity\Formateur;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\GroupeRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 
 * @ORM\Entity(repositoryClass=GroupeRepository::class)
 * @ApiResource(
 * denormalizationContext={"groups"={"groupe:write"}},
 * collectionOperations={
 * 
 *      "get_admin_groupes"={
 *          "normalization_context"={"groups"={"grp:read"}},
 *          "method"= "GET",
 *          "path"= "/admin/groupes",
 *         
 *          
 *      },
 * 
 *     "get_admin_groupes_apprenants"={
 *          "method"= "GET",
 *           "normalization_context"={"groups"={"apprenants:read"}},
 *          "path"= "/admin/groupes/apprenants",
 *          
 *          
 *      },
 *  "Create_groupes_apprennant_formateur"={
 *          "method"= "POST",
 *          "path"= "/admin/groupes",
 *         
 *          
 *      }
 *  },
 * itemOperations={
 * 
 *      "get_admin_groupes_id"={
 *          "method"= "GET",
 *          "path"= "/admin/groupes/{id}",
 *         
 *      },
 * 
 *      "Ajouter_apprenant_groupe"={
 *          "method"= "PUT",
 *          "path"= "/admin/groupes/{id}",
 *      }
 * },
 * )
 */
class Groupe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"promo:read","promo:write","grp:read","grpes:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"promo:read","promo:write","grp:read","groupe:write","grpe_principale:read"})
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"promo:read","grp:read" ,"apprenants:read","groupe:write","grpes:read"})
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"grp:read" ,"groupe:write"})
     */
    private $statut;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"grp:read","groupe:write","grpe_principale:read","rfa:read" })
     */
    private $type;

    

    /**
     * @ORM\ManyToMany(targetEntity=Formateur::class, inversedBy="groupes")
     * @Groups({"grp:read","groupe:write" ,"grpe_principale:read","grpes:read","rfa:read","rfg:read"})
     */
    private $formateurs;

    /**
     * @ORM\ManyToOne(targetEntity=Promo::class, inversedBy="groupe")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"grp:read" ,"apprenants:read","groupe:write","grpe_principale:read"})
     */
    private $promo;

    /**
     * @ORM\ManyToMany(targetEntity=Apprenant::class, inversedBy="groupes",cascade={"persist"})
     * @Groups({"promo:read","promo:write","grp:read","apprenants:read","groupe:write","grpe_principale:read","rfa:read"})
     * @ApiSubresource
     */
    private $apprenants;

   
    public function __construct()
    {
       
        $this->formateurs = new ArrayCollection();
        $this->dateCreation=new \DateTime('now');
        $this->apprenants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDateCreation(): ?string
    {
        return $this->dateCreation;
    }

    public function setDateCreation(string $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

   
    /**
     * @return Collection|Formateur[]
     */
    public function getFormateurs(): Collection
    {
        return $this->formateurs;
    }

    public function addFormateur(Formateur $formateur): self
    {
        if (!$this->formateurs->contains($formateur)) {
            $this->formateurs[] = $formateur;
        }

        return $this;
    }

    public function removeFormateur(Formateur $formateur): self
    {
        $this->formateurs->removeElement($formateur);

        return $this;
    }

    public function getPromo(): ?Promo
    {
        return $this->promo;
    }

    public function setPromo(?Promo $promo): self
    {
        $this->promo = $promo;

        return $this;
    }

    /**
     * @return Collection|Apprenant[]
     */
    public function getApprenants(): Collection
    {
        return $this->apprenants;
    }

    public function addApprenant(Apprenant $apprenant): self
    {
        if (!$this->apprenants->contains($apprenant)) {
            $this->apprenants[] = $apprenant;
        }

        return $this;
    }

    public function removeApprenant(Apprenant $apprenant): self
    {
        $this->apprenants->removeElement($apprenant);

        return $this;
    }

 
}
