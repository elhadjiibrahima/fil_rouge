<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\OpenApi\Options;
use App\Controller\EmailAction;
use DateTime as GlobalDateTime;
use Faker\Provider\ka_GE\DateTime;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Serializer\Annotation\SerializedName;

#[ApiResource(
    normalizationContext:["groups"=>["user:read"]],
    denormalizationContext:["groups"=>["user:write"]],
    collectionOperations:[
        // 'GET', 'POST',
        'validation'=>[
            'method'=>'PATCH',
            'deserialize'=>false,
            'path'=>'user/validate/{token}',
            'controller'=>EmailAction::class
        ]
    ]
)]


#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name:"role", type:"string")]
#[ORM\DiscriminatorMap(["gestionnaire"=>"Gestionnaire","client"=>"Client","livreur"=>"Livreur"])]
#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    protected $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    protected $email;

    #[ORM\Column(type: 'json')]
    protected $roles = [];

    #[ORM\Column(type: 'string')]
    protected $password;

    #[ORM\Column(type: 'string', length: 100)]
    protected $nom;

    #[ORM\Column(type: 'string', length: 100)]
    protected $prenom;

    #[ORM\Column(type: 'string', length: 25,options:["default"=>"1"])]
    protected $etat=1;

    #[SerializedName("password")]
    private $PlainPassword;

    // #[ORM\Column(type: 'string', length: 255)]
    // protected $token="qwerty";

    #[ORM\Column(type: 'boolean', options:['default'=>false])]
    protected $isActivated= false;

    #[ORM\Column(type: 'datetime')]
    protected $expireAt;

    #[ORM\Column(type: 'string', length: 255)]
    protected
     $token;

    public function __construct()    
    {
        $this->generateToken();
    }
    public function generateToken(){
         $this->expireAt=new \DateTime("+1 day");
         $this->token=bin2hex(openssl_random_pseudo_bytes(64));
 }
   
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
    public function getUserIdentifier(): string
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
        $roles[] = 'ROLE_VISITEUR';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getPlainPassword(): ?string
    {
        return $this->PlainPassword;
    }

    public function setPlainPassword(?string $PlainPassword): self
    {
        $this->PlainPassword = $PlainPassword;

        return $this;
    }

    public function isIsActivated(): ?bool
    {
        return $this->isActivated;
    }

    public function setIsActivated(bool $isActivated): self
    {
        $this->isActivated = $isActivated;

        return $this;
    }


    public function getExpireAt(): ?\DateTimeInterface
    {
        return $this->expireAt;
    }

    public function setExpireAt(\DateTimeInterface $expireAt): self
    {
        $this->expireAt = $expireAt;

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(string $token): self
    {
        $this->token = $token;

        return $this;
    }

    
}
