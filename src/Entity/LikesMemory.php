<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LikesMemoryRepository")
 */
class LikesMemory
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $foodId;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $ip;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFoodId(): ?int
    {
        return $this->foodId;
    }

    public function setFoodId(int $foodId): self
    {
        $this->foodId = $foodId;

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
}
