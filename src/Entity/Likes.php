<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LikesRepository")
 */
class Likes
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
     * @ORM\Column(type="integer")
     */
    private $foodLike;   

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

    public function getFoodLike(): ?int
    {
        return $this->foodLike;
    }

    public function setFoodLike(int $foodLike): self
    {
        $this->foodLike = $foodLike;

        return $this;
    }

}
