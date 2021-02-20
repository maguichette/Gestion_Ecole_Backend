<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\GroupeCompetenceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 * 
 * normalizationContext={"groups"={"grpcomp:read"}},
 * denormalizationContext={"groups"={"grpcompetence:write"}},
 *  collectionOperations={
 *   "liste_grpe_competences"={
 *          "normalization_context"={"groups"={"grpcompetence:read"}},
 *          "method"= "GET",
 *          "path" = "admin/grpecompetences",
 * },
 * "get_groupecomp_competence"={
 *          "normalization_context"={"groups"={"grpecompetence:read"}},
 *          "method"= "GET",
 *          "path" = "/admin/grpecompetences/competences",
 *      },
 * "create_grpecompetences"={
 *          "method"= "POST",
 *          "path" = "admin/grpecompetences",
 *      },
 *
 *      * },
 * itemOperations={
 * 
 *      "get_one_grpe_competences"={
 *          "normalization_context"={"groups"={"groupecompetence:read"}},
 *          "method"= "GET",
 *          "path" = "admin/grpecompetences/{id}",
 *      },
 * 
 *
 *       "put groupecomp"= {
 *              
 *               "method"= "PUT",
 *               "path" = "/admin/grpecompetences/{id}",
 *          },
 *  },
 * 
 * )
 * @ORM\Entity(repositoryClass=GroupeCompetenceRepository::class)
 */
class GroupeCompetence
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"competence:write","grpecompetence:read","referentiels:write","competence:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"grpecompetence:read","groupecompetence:read","grpcompetence:write","referentiels:write","competence:read"})
     */
    private $libelle;

    /**
     * @ORM\Column(type="text")
     * @Groups({"grpecompetence:read","groupecompetence:read","grpcompetence:write","grpcomp:read","referentiels:write"})
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity=Competence::class, mappedBy="groupeCompetence")
     * @Groups({"grpcomp:read","grpcompetence:write","grpecompetence:read","groupecompetence:read","grpcomp:read","referentiels:write"})
     * @ApiSubresource
     */
    private $competences;

    /**
     * @ORM\ManyToMany(targetEntity=Referentiel::class, mappedBy="groupecompetences")
     */
    private $referentiels;

    public function __construct()
    {
        $this->competences = new ArrayCollection();
        $this->referentiels = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Competence[]
     */
    public function getCompetences(): Collection
    {
        return $this->competences;
    }

    public function addCompetence(Competence $competence): self
    {
        if (!$this->competences->contains($competence)) {
            $this->competences[] = $competence;
            $competence->addGroupeCompetence($this);
        }

        return $this;
    }

    public function removeCompetence(Competence $competence): self
    {
        if ($this->competences->removeElement($competence)) {
            $competence->removeGroupeCompetence($this);
        }

        return $this;
    }

    /**
     * @return Collection|Referentiel[]
     */
    public function getReferentiels(): Collection
    {
        return $this->referentiels;
    }

    public function addReferentiel(Referentiel $referentiel): self
    {
        if (!$this->referentiels->contains($referentiel)) {
            $this->referentiels[] = $referentiel;
            $referentiel->addGroupecompetence($this);
        }

        return $this;
    }

    public function removeReferentiel(Referentiel $referentiel): self
    {
        if ($this->referentiels->removeElement($referentiel)) {
            $referentiel->removeGroupecompetence($this);
        }

        return $this;
    }
}
