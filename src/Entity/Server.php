<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\ServerRepository")
 */
class Server
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $ip;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Product", inversedBy="servers")
     * @ORM\JoinColumn(nullable=true)
     */
    private $product;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ServerType", inversedBy="servers")
     * @ORM\JoinColumn(nullable=true)
     */
    private $Type;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function setIp(string $ip): self
    {
        $this->ip = $ip;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getType(): ?ServerType
    {
        return $this->Type;
    }

    public function setType(?ServerType $Type): self
    {
        $this->Type = $Type;

        return $this;
    }
}
