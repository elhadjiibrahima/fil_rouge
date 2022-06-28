<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ClientRepository;
use ApiPlatform\Core\Annotation\ApiResource;
#[ApiResource()]

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client extends User
{
    // #[ORM\Id]
    // #[ORM\GeneratedValue]
    // #[ORM\Column(type: 'integer')]
    // private $id;

    #[ORM\Column(type: 'string', length: 100)]
    private $numeroTelephone;

    #[ORM\Column(type: 'string', length: 100)]
    private $address;

    // public function getId(): ?int
    // {
    //     return $this->id;
    // }

    public function getNumeroTelephone(): ?string
    {
        return $this->numeroTelephone;
    }

    public function setNumeroTelephone(string $numeroTelephone): self
    {
        $this->numeroTelephone = $numeroTelephone;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }
}
