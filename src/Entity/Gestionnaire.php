<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\GestionnaireRepository;
use ApiPlatform\Core\Annotation\ApiResource;
#[ApiResource()]

#[ORM\Entity(repositoryClass: GestionnaireRepository::class)]
class Gestionnaire extends User
{
   
}
