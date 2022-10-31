<?php

namespace App\DataFixtures;

use App\Entity\Client;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ClientFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i<=5 ; $i++) { 
            $client=new Client();
            $client->setNomComplet("Client Client $i")
                    ->setLogin("client$i")
                    ->setPassword("client");
            $client->setTel("77 500 1$i 1$i");
            $manager->persist($client);
        }
        $manager->flush();
    }
}
