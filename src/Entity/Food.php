<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FoodsRepository")
 */
class Food
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description2;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $duration;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $pictureName;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creationDate;

    /**
     * @ORM\Column(type="integer")
     */
    private $category;

    /**
     * @ORM\Column(type="integer")
     */
    private $visible;

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

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description): void
    {
        $this->description = $description;
    }

    public function getDescription2()
    {
        return $this->description2;
    }

    public function setDescription2($description2): void
    {
        $this->description2 = $description2;
    }

    public function getDuration()
    {
        return $this->duration;
    }

    public function setDuration($duration): void
    {
        $this->duration = $duration;
    }

    public function getPictureName(): ?string
    {
        return $this->pictureName;
    }

    public function setPictureName(?string $pictureName): self
    {
        $this->pictureName = $pictureName;

        return $this;
    }

    public function getCreationDate()
    {
        return $this->creationDate;
    }

    public function setCreationDate($creationDate): void
    {
        $this->creationDate = $creationDate;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($category): void
    {
        $this->category = $category;
    }

    public function getVisible()
    {
        return $this->visible;
    }

    public function setVisible($visible): void
    {
        $this->visible = $visible;
    }

}
