<?php

namespace App\Entity;

use App\Repository\EpargneRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EpargneRepository::class)]
class Epargne extends Compte
{
   

    #[ORM\Column(nullable: true)]
    private ?float $taux = null;

    public function __construct()
    {
        $this->type="Epargne";
    }

    public function getTaux(): ?float
    {
        return $this->taux;
    }

    public function setTaux(?float $taux): self
    {
        $this->taux = $taux;

        return $this;
    }
}
