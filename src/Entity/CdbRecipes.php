<?php

namespace App\Entity;

use App\Repository\CdbRecipesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CdbRecipesRepository::class)]
class CdbRecipes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column(nullable: true)]
    private ?int $time_days = null;

    #[ORM\Column(nullable: true)]
    private ?int $time_hours = null;

    #[ORM\Column]
    private ?int $time_minutes = null;

    #[ORM\Column(length: 255)]
    private ?string $difficulty = null;

    #[ORM\Column(length: 255)]
    private ?string $pricing = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\ManyToOne(inversedBy: 'cdbRecipes')]
    private ?CdbUsers $created_by = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getTimeHours(): ?int
    {
        return $this->time_hours;
    }

    public function setTimeHours(?int $time_hours): static
    {
        $this->time_hours = $time_hours;

        return $this;
    }

    public function getTimeMinutes(): ?int
    {
        return $this->time_minutes;
    }

    public function setTimeMinutes(int $time_minutes): static
    {
        $this->time_minutes = $time_minutes;

        return $this;
    }

    public function getDifficulty(): ?string
    {
        return $this->difficulty;
    }

    public function setDifficulty(string $difficulty): static
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    public function getPricing(): ?string
    {
        return $this->pricing;
    }

    public function setPricing(string $pricing): static
    {
        $this->pricing = $pricing;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getCreatedBy(): ?CdbUsers
    {
        return $this->created_by;
    }

    public function setCreatedBy(?CdbUsers $created_by): static
    {
        $this->created_by = $created_by;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getTimeDays(): ?int
    {
        return $this->time_days;
    }

    public function setTimeDays(?int $time_days): static
    {
        $this->time_days = $time_days;

        return $this;
    }
}
