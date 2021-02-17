<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\GroupeTagRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=GroupeTagRepository::class)
 * @ApiResource(
 * collectionOperations={
 *      "get"={
 *          "normalization_context"={"groups"={"grpeTags:read"}},
 *          "method" = "GET",
 *          "path" = "/admin/grptags"
 *  },
 * 
 *  "create_grpe_tags"={
 *      "method" = "POST",
 *      "path" = "/admin/grptags"
 *   }
 *   },
 *  itemOperations={
 * 
 *      "get"={
 *          "normalization_context"={"groups"={"tags:read"}},
 *          "method" = "GET",
 *          "path" = "/admin/grptags/{id}"
 *      },
 * 
 *      "put"={
 *          "path"  = "/admin/grptags/{id}"
 *      }
 * },
 * )
 */
class GroupeTag
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
    private $libelle;

    /**
     * @ORM\ManyToMany(targetEntity=Tags::class, mappedBy="groupestags")
     * @Groups({"grpeTags:read","tags:read"})
     */
    private $tags;

   


    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->Tags = new ArrayCollection();
        $this->groupeTags = new ArrayCollection();
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
     * @return Collection|Tags[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tags $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
            $tag->addGroupestag($this);
        }

        return $this;
    }

    public function removeTag(Tags $tag): self
    {
        if ($this->tags->removeElement($tag)) {
            $tag->removeGroupestag($this);
        }

        return $this;
    }

   
}
