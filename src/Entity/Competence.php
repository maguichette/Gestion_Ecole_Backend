<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CompetenceRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @UniqueEntity(
 * fields={"libelle"},
 * message="le libelle doit etre unique"
 * )
 * @ApiResource(
 * normalizationContext={"groups"={"competence:read"}},
 * denormalizationContext={"groups"={"competence:write"}},
 * collectionOperations={
 *      "get"={
 *          "method"= "GET",
 *          "path"= "/admin/competences",
 *          "security" = "(is_granted('ROLE_Admin') or is_granted('ROLE_Formateur') or is_granted('ROLE_CM'))",
 *          
 *      },
 *      "create_competence"={
 *          "method"="POST",
 *          "path"="/admin/competences",
 *          
 * }
 *   
 * },
 * itemOperations={
 * 
 *      "get_levels_competences"={
 *          "method"= "GET",
 *          "path"= "/admin/competences/{id}",
 *          "security" = "(is_granted('ROLE_Admin') or is_granted('ROLE_Formateur') or is_granted('ROLE_CM'))",
 *      },
 * "edit_levels"={
 *          "method"= "PUT",
 *          "path"= "/admin/competences/{id}",
 *          "security" = "is_granted('ROLE_Admin')",
 *      },
 *  },
 * )
 * @ORM\Entity(repositoryClass=CompetenceRepository::class)
 */
class Competence 
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"competence:write","grpcomp:read","grpcompetence:write","grpecompetence:read","competence:read"})
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"competence:write","grpcomp:read","grpcompetence:write","competence:read","grpecompetence:read"})
     */
    private $descripton;

    /**
     * @ORM\OneToMany(targetEntity=Niveau::class, mappedBy="competence",cascade={"persist"})
     *  @Assert\Count(
     *      min = 3,
     *      max =3,    
     *      minMessage = "ajouter au moins 3 niveaux",
     *      maxMessage = "ajouter au plus 3 niveaux",
     * )
     * @Groups({"competence:write","competence:read","grpecompetence:read"})
     */
    private $niveau;

    /**
     * @ORM\ManyToMany(targetEntity=GroupeCompetence::class, inversedBy="competences")
     * @Groups({"competence:write","competence:read"})
     */
    private $groupeCompetence;

    public function __construct()
    {
    
        $this->niveau = new ArrayCollection();
        $this->groupeCompetence = new ArrayCollection();
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

    public function getDescripton(): ?string
    {
        return $this->descripton;
    }

    public function setDescripton(string $descripton): self
    {
        $this->descripton = $descripton;

        return $this;
    }


    /**
     * @return Collection|Niveau[]
     */
    public function getNiveau(): Collection
    {
        return $this->niveau;
    }

    public function addNiveau(Niveau $niveau): self
    {
        if (!$this->niveau->contains($niveau)) {
            $this->niveau[] = $niveau;
            $niveau->setCompetence($this);
        }

        return $this;
    }

    public function removeNiveau(Niveau $niveau): self
    {
        if ($this->niveau->removeElement($niveau)) {
            // set the owning side to null (unless already changed)
            if ($niveau->getCompetence() === $this) {
                $niveau->setCompetence(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|GroupeCompetence[]
     */
    public function getGroupeCompetence(): Collection
    {
        return $this->groupeCompetence;
    }

    public function addGroupeCompetence(GroupeCompetence $groupeCompetence): self
    {
        if (!$this->groupeCompetence->contains($groupeCompetence)) {
            $this->groupeCompetence[] = $groupeCompetence;
        }

        return $this;
    }

    public function removeGroupeCompetence(GroupeCompetence $groupeCompetence): self
    {
        $this->groupeCompetence->removeElement($groupeCompetence);

        return $this;
    }
}
