<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CdbUsersRepository;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: CdbUsersRepository::class)]
#[ORM\Table(name: 'cdb_users')]
#[UniqueEntity(fields: ['email'], message: 'Il existe déjà un compte avec cet e-mail')]
class CdbUsers implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $role = [];

    #[ORM\Column(length: 255)]
    private ?string $first_name = null;

    #[ORM\Column(length: 255)]
    private ?string $last_name = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\OneToMany(mappedBy: 'created_by', targetEntity: CdbNews::class)]
    private Collection $cdbNews;

    #[ORM\OneToMany(mappedBy: 'created_by', targetEntity: CdbPartners::class)]
    private Collection $cdbPartners;

    #[ORM\OneToMany(mappedBy: 'created_by', targetEntity: CdbRecipes::class)]
    private Collection $cdbRecipes;

    public function __construct()
    {
        $this->cdbNews = new ArrayCollection();
        $this->cdbPartners = new ArrayCollection();
        $this->cdbRecipes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): static
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): static
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }
    
    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $role = $this->role;
        // guarantee every user at least has ROLE_USER
        $role[] = 'ROLE_USER';

        return array_unique($role);
    }

    public function setRoles(array $role): self
    {
        $this->role = $role;

        return $this;
    }

        /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection<int, CdbNews>
     */
    public function getCdbNews(): Collection
    {
        return $this->cdbNews;
    }

    public function addCdbNews(CdbNews $cdbNews): self
    {
        if (!$this->cdbNews->contains($cdbNews)) {
            $this->cdbNews->add($cdbNews);
            $cdbNews->setCreatedBy($this);
        }

        return $this;
    }

    public function removeCdbNews(CdbNews $cdbNews): self
    {
        if ($this->cdbNews->removeElement($cdbNews)) {
            // set the owning side to null (unless already changed)
            if ($cdbNews->getCreatedBy() === $this) {
                $cdbNews->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CdbPartners>
     */
    public function getCdbPartners(): Collection
    {
        return $this->cdbPartners;
    }

    public function addCdbPartner(CdbPartners $cdbPartner): self
    {
        if (!$this->cdbPartners->contains($cdbPartner)) {
            $this->cdbPartners->add($cdbPartner);
            $cdbPartner->setCreatedBy($this);
        }

        return $this;
    }

    public function removeCdbPartner(CdbPartners $cdbPartner): self
    {
        if ($this->cdbPartners->removeElement($cdbPartner)) {
            // set the owning side to null (unless already changed)
            if ($cdbPartner->getCreatedBy() === $this) {
                $cdbPartner->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CdbRecipes>
     */
    public function getCdbRecipes(): Collection
    {
        return $this->cdbRecipes;
    }

    public function addCdbRecipe(CdbRecipes $cdbRecipe): static
    {
        if (!$this->cdbRecipes->contains($cdbRecipe)) {
            $this->cdbRecipes->add($cdbRecipe);
            $cdbRecipe->setCreatedBy($this);
        }

        return $this;
    }

    public function removeCdbRecipe(CdbRecipes $cdbRecipe): static
    {
        if ($this->cdbRecipes->removeElement($cdbRecipe)) {
            // set the owning side to null (unless already changed)
            if ($cdbRecipe->getCreatedBy() === $this) {
                $cdbRecipe->setCreatedBy(null);
            }
        }

        return $this;
    }
}
