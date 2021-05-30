<?php

namespace App\Entity;

use App\Repository\ContenutoMultimedialeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups; 

/**
 * @ORM\Entity(repositoryClass=ContenutoMultimedialeRepository::class)
 */
class ContenutoMultimediale
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"default"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200)
     * @Groups({"default"})
     */
    private $link;

    /**
     * @ORM\Column(type="string", length=200)
     * @Groups({"default"})
     */
    private $tipologia;

    /**
     * @ORM\ManyToOne(targetEntity=ALEc::class, inversedBy="centenutoMultimediales")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ID_al_ec;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getTipologia(): ?string
    {
        return $this->tipologia;
    }

    public function setTipologia(string $tipologia): self
    {
        $this->tipologia = $tipologia;

        return $this;
    }

    public function getIDAlEc(): ?ALEc
    {
        return $this->ID_al_ec;
    }

    public function setIDAlEc(?ALEc $ID_al_ec): self
    {
        $this->ID_al_ec = $ID_al_ec;

        return $this;
    }
}
