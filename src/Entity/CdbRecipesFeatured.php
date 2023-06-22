<?php

namespace App\Entity;

use App\Repository\CdbRecipesFeaturedRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CdbRecipesFeaturedRepository::class)]
class CdbRecipesFeatured
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $featured = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFeatured(): ?int
    {
        return $this->featured;
    }

    public function setFeatured(int $featured): static
    {
        $this->featured = $featured;

        return $this;
    }
}
