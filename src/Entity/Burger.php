<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\BurgerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BurgerRepository::class)]
#[ApiResource(
    collectionOperations:["POST","GET"],
    itemOperations:["PUT","GET"]
)]
class Burger extends Produit
{
    // #[ORM\Id]
    // #[ORM\GeneratedValue]
    // #[ORM\Column(type: 'integer')]
    // private $id;

    #[ORM\Column(type: 'string', length: 100)]
    private $categorie;

    // #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'burgers')]
    // private $user;

    // public function getId(): ?int
    // {
    //     return $this->id;
    // }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    // public function getUser(): ?User
    // {
    //     return $this->user;
    // }

    // public function setUser(?User $user): self
    // {
    //     $this->user = $user;

    //     return $this;
    // }
}
