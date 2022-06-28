<?php

namespace App\DataFixtures;

use App\Entity\Client;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ClientFixture extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $hasherPassword)
    {
    }
    public function load(ObjectManager $manager): void
    {
        $faker=Factory::create("fr_FR");
        for ($i=0; $i <10 ; $i++) { 
            $client=new Client;
            $client->setNom($faker->lastName());
            $client->setPrenom($faker->firstName());
            $client->setEmail($faker->email());
            $client->setAddress($faker->address());
            $client->setEtat("1");
            $client->setRoles(["ROLE_CLIENT"]);
            $client->setNumeroTelephone($faker->phoneNumber());
            $client->setPassword($this->hasherPassword->hashPassword($client,$faker->password()));
            $manager->persist($client);
        }
        
        $manager->flush();
    }
    
}
