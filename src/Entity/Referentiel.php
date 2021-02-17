<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ReferentielRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *  denormalizationContext={"groups"={"referentiels:write"}},
 * collectionOperations={
 *      "get"={
 *          "normalization_context"={"groups"={"referentiels":"read"}},
 *          "method"= "GET",
 *          "path" = "/admin/referentiels",
 *           
 *      },
 * "get_grpecompetences_competences"={
 *          "normalization_context"={"groups"={"grpe_and_competences":"read"}},
 *          "method"= "GET",
 *          "path" = "/admin/referentiels/grpecompetences",
 *      },
 * "create_referentiels"={
 *          "method"= "POST",
 *          "path" = "/admin/referentiels",
 *          
 *      },
 * },
 * itemOperations={
 *      "get"={
 *          "normalization_context"={"groups"={"referentiels":"read"}},
 *          "method"= "GET",
 *          "path" = "/admin/referentiels/{id}",
 *           
 *      },
 * 
 *      "edit_grpecompetences_referentiels"={
 *          "method"= "PUT",
 *          "path" = "/admin/referentiels/{id}",
 *           
 *      },
 *  },
 * 
 * )
 * @ORM\Entity(repositoryClass=ReferentielRepository::class)
 */
class Referentiel
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"referentiels":"read", "grpe_principale:read",
     * "grpes:read","rfa:read","rfg:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"referentiels":"read","referentiels:write",
     * "grpe_principale:read","grpes:read","rfa:read","rfg:read"})
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"referentiels":"read","referentiels:write",
     * "grpe_principale:read","grpes:read","rfa:read","rfg:read"})
     */
    private $presentation;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"referentiels":"read","referentiels:write",
     * "grpe_principale:read","grpes:read","rfa:read","rfg:read"})
     */
    private $evaluation;

   

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"referentiels":"read","referentiels:write","grpe_principale:read","rfa:read","rfg:read"})
     */
    private $admission;

    /**
     * @ORM\ManyToMany(targetEntity=GroupeCompetence::class, inversedBy="referentiels")
     * @Groups({"referentiels":"read","grpe_and_competences":"read","referentiels:write"})
     */
    private $groupecompetences;

    

    /**
     * @ORM\Column(type="blob")
     */
    private $Programme;

    /**
     * @ORM\OneToMany(targetEntity=Promo::class, mappedBy="reference")
     */
    private $promos;

    public function __construct()
    {
        $this->groupecompetences = new ArrayCollection();
        $this->promos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getPresentation(): ?string
    {
        return $this->presentation;
    }

    public function setPresentation(string $presentation): self
    {
        $this->presentation = $presentation;

        return $this;
    }

    public function getEvaluation(): ?string
    {
        return $this->evaluation;
    }

    public function setEvaluation(string $evaluation): self
    {
        $this->evaluation = $evaluation;

        return $this;
    }

    

    public function getAdmission(): ?string
    {
        return $this->admission;
    }

    public function setAdmission(string $admission): self
    {
        $this->admission = $admission;

        return $this;
    }

    /**
     * @return Collection|GroupeCompetence[]
     */
    public function getGroupecompetences(): Collection
    {
        return $this->groupecompetences;
    }

    public function addGroupecompetence(GroupeCompetence $groupecompetence): self
    {
        if (!$this->groupecompetences->contains($groupecompetence)) {
            $this->groupecompetences[] = $groupecompetence;
        }

        return $this;
    }

    public function removeGroupecompetence(GroupeCompetence $groupecompetence): self
    {
        $this->groupecompetences->removeElement($groupecompetence);

        return $this;
    }

   

    public function getProgramme()
    {
        return $this->Programme;
    }

    public function setProgramme($Programme): self
    {
        $this->Programme = $Programme;

        return $this;
    }

    /**
     * @return Collection|Promo[]
     */
    public function getPromos(): Collection
    {
        return $this->promos;
    }

    public function addPromo(Promo $promo): self
    {
        if (!$this->promos->contains($promo)) {
            $this->promos[] = $promo;
            $promo->setReference($this);
        }

        return $this;
    }

    public function removePromo(Promo $promo): self
    {
        if ($this->promos->removeElement($promo)) {
            // set the owning side to null (unless already changed)
            if ($promo->getReference() === $this) {
                $promo->setReference(null);
            }
        }

        return $this;
    }
}
