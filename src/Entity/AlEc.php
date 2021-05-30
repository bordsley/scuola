<?php

namespace App\Entity;

use App\Repository\AlEcRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups; 
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * @ORM\Entity(repositoryClass=AlEcRepository::class)
 */
class AlEc
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
     * @ORM\Column(type="integer")
     * @Groups({"default"})
     */
    private $numero_aula;

    /**
     * @ORM\ManyToOne(targetEntity=Indirizzo::class, inversedBy="al_ecs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ID_indirizzo;

    /**
     * @ORM\OneToMany(targetEntity=ContenutoMultimediale::class, mappedBy="ID_al_ec", orphanRemoval=true)
     * @Groups({"default"})
     */
    private $centenutoMultimediales;

    public function __construct()
    {
        $this->centenutoMultimediales = new ArrayCollection();
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

    public function getNumeroAula(): ?int
    {
        return $this->numero_aula;
    }

    public function setNumeroAula(int $numero_aula): self
    {
        $this->numero_aula = $numero_aula;

        return $this;
    }

    public function getIDIndirizzo(): ?Indirizzo
    {
        return $this->ID_indirizzo;
    }

    public function setIDIndirizzo(?Indirizzo $ID_indirizzo): self
    {
        $this->ID_indirizzo = $ID_indirizzo;

        return $this;
    }

    /**
     * @return Collection|ContenutoMultimediale[]
     */
    public function getCentenutoMultimediales(): Collection
    {
        return $this->centenutoMultimediales;
    }

    public function addCentenutoMultimediale(ContenutoMultimediale $centenutoMultimediale): self
    {
        if (!$this->centenutoMultimediales->contains($centenutoMultimediale)) {
            $this->centenutoMultimediales[] = $centenutoMultimediale;
            $centenutoMultimediale->setIDAlEc($this);
        }

        return $this;
    }

    public function removeCentenutoMultimediale(ContenutoMultimediale $centenutoMultimediale): self
    {
        if ($this->centenutoMultimediales->removeElement($centenutoMultimediale)) {
            // set the owning side to null (unless already changed)
            if ($centenutoMultimediale->getIDAlEc() === $this) {
                $centenutoMultimediale->setIDAlEc(null);
            }
        }

        return $this;
    }
}
