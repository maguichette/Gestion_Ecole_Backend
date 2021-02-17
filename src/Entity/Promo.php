<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\PromoRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 * 
 * routePrefix="/admin",
 * collectionOperations={
 * "get_promo"={
 *          "normalization_context"={"groups"={"promo:read"}},
 *          "method"= "GET",
 *          "path"= "/promo",
 *      },
 *       "Ajouter_Apprenant"={ 
 *          "method"= "POST",
 *          "path"= "/promo",
 *          "denormalization_context"={"groups"={"promo:write"}}
 *      },
 * "get_promo_apprenants_attente"={
 *          "method"= "GET",
 *          "path"= "/promo/apprenants/attentes",
 * 
 *      },
 *  "get_admin_promo_principal"={
 *          "method"= "GET",
 *          "path"= "/promo/principal",
 *          "normalization_context"={"groups"={"grpe_principale:read"}},
 *      },
 *
 * },
 *  itemOperations={
 *          "get_promo_id"={
 *              "path"="/promo/{id}",
 *                  "method"="GET",
 *              "normalization_context"={"groups"={"grpes:read"}},
 * },
 *     "get_promo_id_principal"={
 *          "normalization_context"={"groups"={"rfa:read"}},
 *          "method"= "GET",
 *          "path"= "/promo/{id}/principal",
 *          
 *      },
 *  "referentiels_get" = {
*               "method"= "GET",
*               "normalization_context"={"groups"={"ref_promo_gc:read"}},
*                "path" = "/promo/{id}/referentiels",
*                
*          },
* "formateurs_get_subresource"= {
 *              "normalization_context"={"groups"={"rfg:read"}},
 *               "method"= "GET",
 *               "path" = "/promo/{id}/formateurs",
 *                
 *          } ,   
 *   },
 * )
 * @ORM\Entity(repositoryClass=PromoRepository::class)
 */
class Promo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"promo:read","grp:read","groupe:write","grpe_principale:read","rfg:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"promo:read","promo:write","grpe_principale:read","rfg:read"})
     */
    private $langue;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"promo:read","promo:write","grpe_principale:read","rfg:read"})
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"promo:read","promo:write"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"promo:read","promo:write"})
     */
    private $lieu;

    
    /**
     * @ORM\Column(type="date")
     * @Groups({"promo:read","promo:write","grpe_principale:read"})
     */
    private $dateDebut;

    /**
     * @ORM\Column(type="date")
     * @Groups({"promo:read","promo:write","grpe_principale:read"})
     */
    private $dateFin;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"promo:read","promo:write","grpe_principale:read"})
     */
    private $etat;

   
 

    /**
     * @ORM\Column(type="date")
     * @Groups({"promo:read","promo:write","grpe_principale:read"})
     */
    private $DateFinProvisoire;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"promo:read","promo:write","grpe_principale:read"})
     */
    private $fabrique;

    /**
     * @ORM\OneToMany(targetEntity=Groupe::class, mappedBy="promo",cascade={"persist"})
     * @Groups({"promo:read","promo:write","grpe_principale:read","grpes:read","rfa:read","rfg:read"})
     * @ApiSubresource
     */
    private $groupe;

    /**
     * @ORM\ManyToOne(targetEntity=Referentiel::class, inversedBy="promos")
     * @Groups({"grpe_principale:read","grpes:read","rfa:read","rfg:read"})
     * 
     */
    private $reference;

    public function __construct()
    {
        $this->groupe = new ArrayCollection();
    }

   

 

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLangue(): ?string
    {
        return $this->langue;
    }

    public function setLangue(string $langue): self
    {
        $this->langue = $langue;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }

 

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    
    public function getDateFinProvisoire(): ?\DateTimeInterface
    {
        return $this->DateFinProvisoire;
    }

    public function setDateFinProvisoire(\DateTimeInterface $DateFinProvisoire): self
    {
        $this->DateFinProvisoire = $DateFinProvisoire;

        return $this;
    }

    public function getFabrique(): ?string
    {
        return $this->fabrique;
    }

    public function setFabrique(string $fabrique): self
    {
        $this->fabrique = $fabrique;

        return $this;
    }

    /**
     * @return Collection|Groupe[]
     */
    public function getGroupe(): Collection
    {
        return $this->groupe;
    }

    public function addGroupe(Groupe $groupe): self
    {
        if (!$this->groupe->contains($groupe)) {
            $this->groupe[] = $groupe;
            $groupe->setPromo($this);
        }

        return $this;
    }

    public function removeGroupe(Groupe $groupe): self
    {
        if ($this->groupe->removeElement($groupe)) {
            // set the owning side to null (unless already changed)
            if ($groupe->getPromo() === $this) {
                $groupe->setPromo(null);
            }
        }

        return $this;
    }

    public function getReference(): ?Referentiel
    {
        return $this->reference;
    }

    public function setReference(?Referentiel $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

}
