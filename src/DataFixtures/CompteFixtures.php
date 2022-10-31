<?php

namespace App\DataFixtures;

use App\Entity\Cheque;
use App\Entity\Epargne;
use App\Repository\AgenceRepository;
use App\Repository\ClientRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CompteFixtures extends Fixture
{
    private AgenceRepository $agenceRepository;
    private ClientRepository $clientRepository;
    public function __construct(AgenceRepository $agenceRepository,ClientRepository $clientRepository)
    {
        $this->agenceRepository=$agenceRepository;
        $this->clientRepository=$clientRepository;
    }
    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i <=10 ; $i++) { 
            $numAg=rand(1,3);
            $numCl=rand(1,5);
            $compte=null;
            if ($i%2==0) {
               $compte=new Epargne();
               $compte->setTaux(0.05); 
            }else{
                $compte=new Cheque();
                $compte->setFrais(200);
            }
            $compte->setNumero("CPT_$i")
                    ->setSolde(200000);
            $agence=$this->agenceRepository->findOneBy(["numero"=>"AG_$numAg"]);
            $client=$this->clientRepository->findOneBy(["tel"=>"77 500 1$numCl 1$numCl"]);

            $compte->setClient($client);
            $compte->setAgence($agence);
            
            $manager->persist($compte);
        }
       

        $manager->flush();
    }
}
