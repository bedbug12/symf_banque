<?php

namespace App\Entity;

use App\Repository\CarteGapRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarteGapRepository::class)]
class CarteGap
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 11)]
    private ?string $numero = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $dateExpAt = null;

    #[ORM\OneToOne(mappedBy: 'carteGap', cascade: ['persist', 'remove'])]
    private ?Cheque $cheque = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getDateExpAt(): ?\DateTimeImmutable
    {
        return $this->dateExpAt;
    }

    public function setDateExpAt(\DateTimeImmutable $dateExpAt): self
    {
        $this->dateExpAt = $dateExpAt;

        return $this;
    }

    public function getCheque(): ?Cheque
    {
        return $this->cheque;
    }

    public function setCheque(?Cheque $cheque): self
    {
        // unset the owning side of the relation if necessary
        if ($cheque === null && $this->cheque !== null) {
            $this->cheque->setCarteGap(null);
        }

        // set the owning side of the relation if necessary
        if ($cheque !== null && $cheque->getCarteGap() !== $this) {
            $cheque->setCarteGap($this);
        }

        $this->cheque = $cheque;

        return $this;
    }
}
