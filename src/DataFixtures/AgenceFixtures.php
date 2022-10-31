<?php

namespace App\DataFixtures;

use App\Entity\Agence;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AgenceFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
      $agences=["POINT E","FASS","FANN"];
      foreach ($agences as $key => $value) {
        $agence=new Agence();
        $agence->setNumero("AG_".($key+1))
                ->setAdresse($value)
                ->setTel("33 800 1$key 1$key");
        $manager->persist($agence);
      }

        $manager->flush();
    }
}
