<?php

namespace App\Entity;

use App\Repository\BigliettoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups; 
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * @ORM\Entity(repositoryClass=BigliettoRepository::class)
 */
class Biglietto implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"data"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups({"data"})
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"data"})
     */
    private $tipo_giro;

    /**
     * @ORM\Column(type="date")
     * @Groups({"data"})
     */
    private $data_biglietto;

    /**
     * @ORM\OneToMany(targetEntity=BigliettoIndirizzo::class, mappedBy="ID_biglietto", orphanRemoval=true)
     * @Groups({"default"})
     */
    private $bigliettoIndirizzos;

    public function __construct()
    {
        $this->bigliettoIndirizzos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getTipoGiro(): ?string
    {
        return $this->tipo_giro;
    }

    public function setTipoGiro(string $tipo_giro): self
    {
        $this->tipo_giro = $tipo_giro;

        return $this;
    }

    public function getDataBiglietto(): ?\DateTimeInterface
    {
        return $this->data_biglietto;
    }

    public function setDataBiglietto(\DateTimeInterface $data_biglietto): self
    {
        $this->data_biglietto = $data_biglietto;

        return $this;
    }

    /**
     * @return Collection|BigliettoIndirizzo[]
     * @MaxDepth(6)
     */
    public function getBigliettoIndirizzos(): Collection
    {
        return $this->bigliettoIndirizzos;
    }

    public function addBigliettoIndirizzo(BigliettoIndirizzo $bigliettoIndirizzo): self
    {
        if (!$this->bigliettoIndirizzos->contains($bigliettoIndirizzo)) {
            $this->bigliettoIndirizzos[] = $bigliettoIndirizzo;
            $bigliettoIndirizzo->setID_biglietto($this);
        }

        return $this;
    }

    public function removeBigliettoIndirizzo(BigliettoIndirizzo $bigliettoIndirizzo): self
    {
        if ($this->bigliettoIndirizzos->removeElement($bigliettoIndirizzo)) {
            // set the owning side to null (unless already changed)
            if ($bigliettoIndirizzo->getID_biglietto() === $this) {
                $bigliettoIndirizzo->setID_biglietto(null);
            }
        }

        return $this;
    }
}
