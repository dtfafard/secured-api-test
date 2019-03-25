<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product extends SeedboxEntityAbstract
{
    use NameStatusEntityTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="smallint")
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Server", mappedBy="product")
     */
    private $servers;

    /**
     * Product constructor.
     */
    public function __construct()
    {
        $this->servers = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Product
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * FROM DAVID :     To ease the work, I've not validated the input not setup a set of available statuses for
     *                  the Product entity
     *
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * @param int $status
     * @return Product
     */
    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection|Server[]
     */
    public function getServers(): Collection
    {
        return $this->servers;
    }

    /**
     * @param Server $server
     * @return Product
     */
    public function addServer(Server $server): self
    {
        if (!$this->servers->contains($server)) {
            $this->servers[] = $server;
            $server->setProduct($this);
        }

        return $this;
    }

    /**
     * @param Server $server
     * @return Product
     */
    public function removeServer(Server $server): self
    {
        if ($this->servers->contains($server)) {
            $this->servers->removeElement($server);
            // set the owning side to null (unless already changed)
            if ($server->getProduct() === $this) {
                $server->setProduct(null);
            }
        }

        return $this;
    }
}
