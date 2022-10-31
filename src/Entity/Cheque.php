<?php

namespace App\Entity;

use App\Repository\ChequeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChequeRepository::class)]
class Cheque extends Compte
{
  
    #[ORM\Column(nullable: true)]
    private ?float $frais = null;

    #[ORM\OneToOne(inversedBy: 'cheque', cascade: ['persist', 'remove'])]
    private ?CarteGap $carteGap = null;

    public function __construct()
    {
        $this->type="Cheque";
    }

    public function getFrais(): ?float
    {
        return $this->frais;
    }

    public function setFrais(?float $frais): self
    {
        $this->frais = $frais;

        return $this;
    }

    public function getCarteGap(): ?CarteGap
    {
        return $this->carteGap;
    }

    public function setCarteGap(?CarteGap $carteGap): self
    {
        $this->carteGap = $carteGap;

        return $this;
    }
}
