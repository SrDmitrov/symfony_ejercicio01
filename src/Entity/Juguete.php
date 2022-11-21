<?php

namespace App\Entity;

use App\Repository\JugueteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=JugueteRepository::class)
 */
class Juguete
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
     * @ORM\Column(type="string", length=100)
     */
    private $marca;

    /**
     * @ORM\ManyToOne(targetEntity=Publico::class, inversedBy="juguetes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $publico;

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

    public function getMarca(): ?string
    {
        return $this->marca;
    }

    public function setMarca(string $marca): self
    {
        $this->marca = $marca;

        return $this;
    }

    public function getPublico(): ?Publico
    {
        return $this->publico;
    }

    public function setPublico(?Publico $publico): self
    {
        $this->publico = $publico;

        return $this;
    }
}
