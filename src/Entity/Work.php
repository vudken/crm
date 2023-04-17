<?php

namespace App\Entity;

use App\Repository\WorkRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WorkRepository::class)]
class Work
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $material = null;
    
    #[ORM\Column(nullable: true)]
    private ?bool $isCompleted = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getMaterial(): ?string
    {
        return $this->material;
    }

    public function setMaterial(?string $material): self
    {
        $this->material = $material;

        return $this;
    }

    public function isIsCompleted(): ?bool
    {
        return $this->isCompleted;
    }

    public function setIsCompleted(?bool $isCompleted): self
    {
        $this->isCompleted = $isCompleted;

        return $this;
    }
}