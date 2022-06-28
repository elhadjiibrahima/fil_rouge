<?php

namespace App\DataFixtures;

use App\Entity\Client;
use App\Entity\Gestionnaire;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class GestionnaireFixture extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $hasherPassword)
    {
    }
    public function load(ObjectManager $manager): void
    {
        $ges = new Gestionnaire;
        $ges->setNom("Gueye");
        $ges->setPrenom("Moustaph");
        $ges->setEmail("moustaph@gmail.com");
        // $password=$this->hashPassword($ges,"passer");
        $ges->setPassword($this->hasherPassword->hashPassword($ges,"passer"));
        $ges->setRoles(["ROLE_GESTIONNAIRE"]);
        $ges->setEtat("1");

        $manager->persist($ges);


        $manager->flush();
    }
}
