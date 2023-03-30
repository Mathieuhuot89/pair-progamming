<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Assert\NotBlank (message: 'Veuillez renseigner votre émail')]
    private ?string $email = null;
    
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    
    #[ORM\Column]
    #[Assert\NotBlank (message: 'Veuillez renseigner votre password ')]
    #[Assert\Length(
        min: 5, max: 30,
        minMessage:"Le password doit contenir entre 5 et 30 caracteres")]
    private ?string $password = null;


    #[ORM\Column(length: 255)]
    #[Assert\NotBlank (message: 'Veuillez renseigner votre nom')]
    #[Assert\Length(
        min: 2,
        minMessage:"Le prénom doit contenir au min 2 caracteres")]
    private ?string $nom = null;


    #[ORM\Column(length: 255)]
    #[Assert\NotBlank (message: 'Veuillez renseigner votre prénom ')]
    #[Assert\Length(
        min: 2,
        minMessage:"Le nom doit contenir au min 2 caracteres")]
    private ?string $prenom = null;


    #[ORM\Column(length: 255)]
    #[Assert\NotBlank (message: 'Veuillez renseigner votre adresse ')]
    #[Assert\Length]
    private ?string $adresse = null;


    #[ORM\Column(length: 255)]
    #[Assert\NotBlank (message: 'Veuillez renseigner votre ville ')]
    #[Assert\Length(
        min: 2,
        minMessage:"La ville doit contenir au min 2 caracteres")]
    private ?string $ville = null;


    #[ORM\Column(length: 255)]
    #[Assert\NotBlank (message: 'Veuillez renseigner votre pays ')]
    private ?string $pays = null;


    #[ORM\Column]
    #[Assert\NotBlank (message: 'Veuillez renseigner votre code postal ')]
    #[Assert\Length(
        min: 5, max: 5,)]
    #[Assert\Regex(pattern: '/^[0-9]{5}$/', message: 'Votre code postal doit etre composer de 5 chiffres')]
    private ?int $codePostal = null;


    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Commande::class, orphanRemoval: true)]
    private Collection $commandes;


    public function __construct()
    {
        $this->userId = new ArrayCollection();
        $this->commandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

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
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getCodePostal(): ?int
    {
        return $this->codePostal;
    }

    public function setCodePostal(int $codePostal): self
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection<int, Commande>
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes->add($commande);
            $commande->setUser($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getUser() === $this) {
                $commande->setUser(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return this->nom . ' ' . $this->prenom;
    }

}
