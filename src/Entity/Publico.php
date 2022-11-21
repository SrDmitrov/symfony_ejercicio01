<?php

namespace App\Entity;

use App\Repository\PublicoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PublicoRepository::class)
 */
class Publico
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @ORM\OneToMany(targetEntity=Juguete::class, mappedBy="publico")
     */
    private $juguetes;

    public function __construct()
    {
        $this->juguetes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * @return Collection<int, Juguete>
     */
    public function getJuguetes(): Collection
    {
        return $this->juguetes;
    }

    public function addJuguete(Juguete $juguete): self
    {
        if (!$this->juguetes->contains($juguete)) {
            $this->juguetes[] = $juguete;
            $juguete->setPublico($this);
        }

        return $this;
    }

    public function removeJuguete(Juguete $juguete): self
    {
        if ($this->juguetes->removeElement($juguete)) {
            // set the owning side to null (unless already changed)
            if ($juguete->getPublico() === $this) {
                $juguete->setPublico(null);
            }
        }

        return $this;
    }
}
