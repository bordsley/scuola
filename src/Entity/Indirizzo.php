<?php

namespace App\Entity;

use App\Repository\IndirizzoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups; 
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * @ORM\Entity(repositoryClass=IndirizzoRepository::class)
 */
class Indirizzo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"default"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=500)
     * @Groups({"default"})
     */
    private $descrizione;

    /**
     * @ORM\OneToMany(targetEntity=AlEc::class, mappedBy="ID_indirizzo", orphanRemoval=true)
     * @Groups({"default"})
     */
    private $al_ecs;

    /**
     * @ORM\OneToOne(targetEntity=BigliettoIndirizzo::class, mappedBy="ID_indirizzo", cascade={"persist", "remove"})
     */
    private $bigliettoIndirizzo;

    public function __construct()
    {
        $this->al_ecs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescrizione(): ?string
    {
        return $this->descrizione;
    }

    public function setDescrizione(string $descrizione): self
    {
        $this->descrizione = $descrizione;

        return $this;
    }

    /**
     * @return Collection|AlEc[]
     * @MaxDepth(4)
     */
    public function getAlEcs(): Collection
    {
        return $this->al_ecs;
    }

    public function addAlEc(AlEc $alEc): self
    {
        if (!$this->al_ecs->contains($alEc)) {
            $this->al_ecs[] = $alEc;
            $alEc->setIDIndirizzo($this);
        }

        return $this;
    }

    public function removeAlEc(AlEc $alEc): self
    {
        if ($this->al_ecs->removeElement($alEc)) {
            // set the owning side to null (unless already changed)
            if ($alEc->getIDIndirizzo() === $this) {
                $alEc->setIDIndirizzo(null);
            }
        }

        return $this;
    }

    public function getBigliettoIndirizzo(): ?BigliettoIndirizzo
    {
        return $this->bigliettoIndirizzo;
    }

    public function setBigliettoIndirizzo(BigliettoIndirizzo $bigliettoIndirizzo): self
    {
        // set the owning side of the relation if necessary
        if ($bigliettoIndirizzo->getID_indirizzo() !== $this) {
            $bigliettoIndirizzo->setID_indirizzo($this);
        }

        $this->bigliettoIndirizzo = $bigliettoIndirizzo;

        return $this;
    }
}