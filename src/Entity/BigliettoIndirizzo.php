<?php

namespace App\Entity;

use App\Repository\BigliettoIndirizzoRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups; 
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * @ORM\Entity(repositoryClass=BigliettoIndirizzoRepository::class)
 */
class BigliettoIndirizzo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Biglietto::class, inversedBy="bigliettoIndirizzos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ID_biglietto;

    /**
     * @ORM\OneToOne(targetEntity=Indirizzo::class, inversedBy="bigliettoIndirizzo", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"default"})
     */
    private $ID_indirizzo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getID_biglietto(): ?Biglietto
    {
        return $this->ID_biglietto;
    }

    public function setID_biglietto(?Biglietto $ID_biglietto): self
    {
        $this->ID_biglietto = $ID_biglietto;

        return $this;
    }

    public function getID_indirizzo(): ?Indirizzo
    {
        return $this->ID_indirizzo;
    }

    public function setID_indirizzo(Indirizzo $ID_indirizzo): self
    {
        $this->ID_indirizzo = $ID_indirizzo;

        return $this;
    }
}
