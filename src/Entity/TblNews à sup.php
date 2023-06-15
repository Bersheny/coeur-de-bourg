<?php

namespace App\Entity;

use App\Repository\TblNewsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TblNewsRepository::class)]
class TblNews
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

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $start_date_time = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $end_date_time = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\ManyToOne(inversedBy: 'tblNews')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TblUsers $created_by_id = null;

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getStartDateTime(): ?\DateTimeImmutable
    {
        return $this->start_date_time;
    }

    public function setStartDateTime(\DateTimeImmutable $start_date_time): static
    {
        $this->start_date_time = $start_date_time;

        return $this;
    }

    public function getEndDateTime(): ?\DateTimeImmutable
    {
        return $this->end_date_time;
    }

    public function setEndDateTime(\DateTimeImmutable $end_date_time): static
    {
        $this->end_date_time = $end_date_time;

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

    public function getCreatedById(): ?TblUsers
    {
        return $this->created_by_id;
    }

    public function setCreatedById(?TblUsers $created_by_id): static
    {
        $this->created_by_id = $created_by_id;

        return $this;
    }
}
