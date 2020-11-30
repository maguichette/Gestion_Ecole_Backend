<?php

namespace App\Entity;

use App\Entity\CM;
use App\Entity\Admin;
use App\Entity\Apprenant;
use App\Entity\Formateur;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping\InheritanceType;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"admin"="Admin","apprenant"="Apprenant", "cm"="CM" , "formateur"="Formateur" ,"user"="User"})
 * @ApiResource(
 *      
 *  attributes={
 *      
 * 
 *      "security" = "is_granted('ROLE_Admin')",
 *      "security_message" = "vous n'avez pas accès"
 *   },
 * 
 * collectionOperations={
 *  "get_users"={
 *          "method"= "GET",
 *          "path" = "/admin/users",
 *          "normalization_context"={"groups"={"user:read"}},
 *          
 *   },
 * "create_users"={
 *          "method"= "POST",
 *          "path" = "/admin/users",
 *          "route_name"="create_user",
 *   },
 * },
 * itemOperations={
 * 
 *  "get_one_user"={
 *             "method"="GET",
 *             "path" = "/admin/users/{id}",
 *              "normalization_context"={"groups"={"user:read"}},
 * },
 * "modif_user"={
 *     "route_name"="modifier_user",
*      "path"="/admin/users/{id}",
 *      "methods"={"PUT"},
 *   },
 *  },
 * )
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"profil:read","user:read","user:write"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups({"profil:read","user:read","user:write"})
     * @Assert\Email(message="veuillez entrer un email valide")
     */
    private $email;

   
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Groups({"profil:read","user:read","user:write"})
     * @Assert\NotBlank(message="veuillez entrer votre password")
     */
    private $password;

    /**
     * @ORM\Column(type="integer")
     */
    private $archive=0;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"profil:read","user:read","user:write"})
     * @Assert\NotBlank(message="veuillez entrer votre nom")
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"profil:read","user:read","user:write"})
     * @Assert\NotBlank(message="veuillez entrer votre prenom")
     */
    private $prenom;

    /**
     * @ORM\ManyToOne(targetEntity=Profil::class, inversedBy="users")
     * @Groups({"profil:read","user:read","user:write"})
     * @Assert\NotBlank(message="veuillez entrer le profil")
     */
    private $profil;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"profil:read","user:read","user:write"})
     * @Assert\NotBlank(message="veuillez entrer le telephone")
     */
    private $Telephone;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"profil:read","user:read","user:write"})
     * @Assert\NotBlank(message="veuillez entrer l'adressse")
     */
    private $Adresse;

    /**
     * @ORM\Column(type="blob",nullable=true)
     * @Groups({"profil:read","user:read","user:write"})
     */
    private $avatar;

   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_'.$this->profil->getLibelle();

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getArchive(): ?int
    {
        return $this->archive;
    }

    public function setArchive(int $archive): self
    {
        $this->archive = $archive;

        return $this;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getProfil(): ?Profil
    {
        return $this->profil;
    }

    public function setProfil(?Profil $profil): self
    {
        $this->profil = $profil;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->Telephone;
    }

    public function setTelephone(string $Telephone): self
    {
        $this->Telephone = $Telephone;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->Adresse;
    }

    public function setAdresse(string $Adresse): self
    {
        $this->Adresse = $Adresse;

        return $this;
    }

    public function getAvatar()
    {
        $photo=$this->avatar;
        if (is_resource($photo)) {
            return base64_encode(stream_get_contents($photo));
        }
        return $this->avatar;
    }

    public function setAvatar($avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

   
 
}
