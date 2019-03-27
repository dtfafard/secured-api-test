<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"read", "server"}, "enable_max_depth"="true"},
 *     denormalizationContext={"groups"={"write"}}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\ServerRepository")
 */
class Server extends SeedboxEntityAbstract
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, unique=true)
     * @Groups({"read", "write", "server-type", "product", "server"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"read", "write", "server"})
     */
    private $ip;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Product", inversedBy="servers")
     * @ORM\JoinColumn(nullable=true)
     * @Groups({"read", "write", "server"})
     * @MaxDepth(1)
     */
    private $product;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ServerType", inversedBy="servers")
     * @ORM\JoinColumn(nullable=true)
     * @Groups({"read", "write", "server"})
     * @MaxDepth(1)
     */
    private $Type;

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
     * @return Server
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getIp(): ?string
    {
        return $this->ip;
    }

    /**
     * @param string $ip
     * @return Server
     */
    public function setIp(string $ip): self
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * @return Product|null
     */
    public function getProduct(): ?Product
    {
        return $this->product;
    }

    /**
     * @param Product|null $product
     * @return Server
     */
    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    /**
     * @return ServerType|null
     */
    public function getType(): ?ServerType
    {
        return $this->Type;
    }

    /**
     * @param ServerType|null $Type
     * @return Server
     */
    public function setType(?ServerType $Type): self
    {
        $this->Type = $Type;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function initData(array $data): SeedboxEntityInterface
    {
        $this->setName($data['name'])
            ->setIp($data['ip'])
            ->setProduct($data['product'])
            ->setType($data['type']);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function validateInitData(array $data): bool
    {
        if (!isset($data['name'])) {
            throw new \InvalidArgumentException('Missing Name');
        }

        if (!isset($data['ip'])) {
            throw new \InvalidArgumentException('Missing IP');
        }

        if (!isset($data['product'])) {
            throw new \InvalidArgumentException('Missing Product');
        }

        if (!isset($data['type'])) {
            throw new \InvalidArgumentException('Missing Server Type');
        }

        return true;
    }
}
