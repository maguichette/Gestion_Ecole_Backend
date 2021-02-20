<?php

namespace App\Entity;

use App\Repository\ProfilSortieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource (
  *   routePrefix="/admin",
 *        attributes={
 *         "normalization_context"={"groups"={"profil_sortie:read"}}
 *     },
 *     collectionOperations={
 *
 *      "get",
 *
 *        "create_profils_sortie"={
 *          "method"= "POST",
 *          "path" = "/profils_sorties"
 *      }
 * },
 *  itemOperations={
  *
  *      "get_profils_sortie"={
 *          "method"= "GET",
 *          "path" = "/profils_sorties/{id}"
 *      },
  *
  *
  *
  *      "edit_profils_sortie"={
  *          "method"= "PUT",
  *          "path" = "/profils_sorties/{id}"
  *      },
 *     "delete_profils_sortie"={
 *          "method"= "DELETE",
 *          "path" = "/profils_sorties/{id}"
 *      },
  *
  * }
 * )
 * @ORM\Entity(repositoryClass=ProfilSortieRepository::class)
 */
class ProfilSortie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"profil_sortie:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"profil_sortie:read"})
     */
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity=Apprenant::class, mappedBy="profilSortie")
     */
    private $apprenants;

    public function __construct()
    {
        $this->apprenants = new ArrayCollection();
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
            $apprenant->setProfilSortie($this);
        }

        return $this;
    }

    public function removeApprenant(Apprenant $apprenant): self
    {
        if ($this->apprenants->removeElement($apprenant)) {
            // set the owning side to null (unless already changed)
            if ($apprenant->getProfilSortie() === $this) {
                $apprenant->setProfilSortie(null);
            }
        }

        return $this;
    }
}
