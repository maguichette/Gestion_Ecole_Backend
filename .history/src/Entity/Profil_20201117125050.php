<?php

namespace App\Entity;

use App\Repository\ProfilRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProfilRepository::class)
 */
class Profil
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;

 

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



    public function addManyToOne(User $manyToOne): self
    {
        if (!$this->ManyToOne->contains($manyToOne)) {
            $this->ManyToOne[] = $manyToOne;
            $manyToOne->setProfil($this);
        }

        return $this;
    }

    public function removeManyToOne(User $manyToOne): self
    {
        if ($this->ManyToOne->removeElement($manyToOne)) {
            // set the owning side to null (unless already changed)
            if ($manyToOne->getProfil() === $this) {
                $manyToOne->setProfil(null);
            }
        }

        return $this;
    }
    
}
