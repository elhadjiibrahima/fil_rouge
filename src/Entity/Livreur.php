<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\LivreurRepository;
use ApiPlatform\Core\Annotation\ApiResource;
#[ApiResource()]

#[ORM\Entity(repositoryClass: LivreurRepository::class)]
class Livreur extends User
{
    // #[ORM\Id]
    // #[ORM\GeneratedValue]
    // #[ORM\Column(type: 'integer')]
    // private $id;

    #[ORM\Column(type: 'string', length: 100)]
    private $matriculeMoto;

    // #[ORM\Column(type: 'string', length: 25)]
    // private $etat;

    // // public function getId(): ?int
    // // {
    // //     return $this->id;
    // }

    public function getMatriculeMoto(): ?string
    {
        return $this->matriculeMoto;
    }

    public function setMatriculeMoto(string $matriculeMoto): self
    {
        $this->matriculeMoto = $matriculeMoto;

        return $this;
    }

    // public function getEtat(): ?string
    // {
    //     return $this->etat;
    // }

    // public function setEtat(string $etat): self
    // {
    //     $this->etat = $etat;

    //     return $this;
    // }
}
