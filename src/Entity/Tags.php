<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\TagsRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=TagsRepository::class)
 * @ApiResource(
 * collectionOperations={
 *      "get"={
 *          "normalization_context"={"groups"={"tags:read"}},
 *          "method" = "GET",
 *          "path" = "/admin/tags"
 *      },
 * 
 *      "create_tags"={
 *          "method" = "POST",
 *          "path" = "/admin/tags"
 *      },
 * 
 * },
 * itemOperations={
 * 
 *      "get"={
 *          "normalization_context"={"groups"={"tags:read"}},
 *          "method" = "GET",
 *          "path" = "/admin/tags/{id}"
 *      },
 * "edit_tags"={
 *          "method" = "PUT",
 *          "path" = "/admin/tags/{id}"
 *      }
 * },
 * )
 */
class Tags
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"grpeTags:read","tags:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"grpeTags:read","tags:read"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"grpeTags:read","tags:read"})
     */
    private $libelle;

    /**
     * @ORM\ManyToMany(targetEntity=GroupeTag::class, inversedBy="tags")
     * @Groups({"tags:read"})
     */
    private $groupestags;



    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->groupestags = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
     * @return Collection|GroupeTag[]
     */
    public function getGroupestags(): Collection
    {
        return $this->groupestags;
    }

    public function addGroupestag(GroupeTag $groupestag): self
    {
        if (!$this->groupestags->contains($groupestag)) {
            $this->groupestags[] = $groupestag;
        }

        return $this;
    }

    public function removeGroupestag(GroupeTag $groupestag): self
    {
        $this->groupestags->removeElement($groupestag);

        return $this;
    }

   

}
