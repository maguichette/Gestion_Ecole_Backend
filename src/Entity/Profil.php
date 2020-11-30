<?php

namespace App\Entity;

use App\Entity\User;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProfilRepository;
use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
// use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ORM\Entity(repositoryClass=ProfilRepository::class)
 * @UniqueEntity("libelle")
 * @ApiResource(
 *  attributes={
 *      "denormalization_context"={"groups"={"user:write"}},
 *      "security" = "is_granted('ROLE_Admin')",
 *      "security_message" = "vous n'avez pas accès "
 * },
 * collectionOperations={
 *      "get_profils"={
 *          "method"= "GET",
 *          "path" = "/admin/profils",
 *          "normalization_context"={"groups"={"profil:read"}},
 *      },
 *      "create_profils"={
 *          "method"= "POST",
 *          "path" = "/admin/profils",
 *      },
 *      },
 * itemOperations={
 *
 *      "users_get_subresource"= {
 *               "normalization_context"={"groups"={"profil:read"}},
 *               "method"= "GET",
 *                "path" = "/admin/profils/{id}/users",
 *        },
 * "get_one_profil"={
 *             "method"="GET",
 *             "path" = "/admin/profils/{id}",
 *             "normalization_context"={"groups"={"profil:read"}},
 *      },
 *      "delete_profil"={
 *             "method"="DELETE",
 *             "path" = "/admin/profils/{id}",
 *      },
 *      "edit_profil"={
 *             "method"="PUT",
 *             "path" = "/admin/profils/{id}",
 *      }
 
 *    },
 * )
 */
class Profil
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     */
    private $id;
    /**
     * @MaxDepth(1)
     */

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"profil:read","user:write"})
     *
     */
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="profil")
     * @Assert\NotBlank(message="veuillez entrer  le libelle")
    
     */
    private $users;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $statut;

     

    public function __construct()
    {
        $this->users = new ArrayCollection();
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
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setProfil($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getProfil() === $this) {
                $user->setProfil(null);
            }
        }

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(?string $statut): self
    {
        $this->statut = $statut;

        return $this;
    } 


    
}
