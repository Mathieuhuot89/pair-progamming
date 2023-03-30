<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
class Comment{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'text')]
    #[Assert\NotBlank]
    private string $content;

    #[ORM\Column(type: 'boolean')]
    private bool $isApproved = false;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColvmn (nullable: false)]
    private User $author;

    #[ORM\ManyToOne(targetEntity: Voiture::class, inversedBy: 'comments')]
    #[ORM\JoinColvmn (nullable: false)]
    private Voiture $voiture;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable $created;

    public function __construct()
    {
        $this->created = new DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getIsApproved(): bool
    {
        return $this->isApproved;
    }

    public function setIsApproved(bool $isApproved): void
    {
        $this->isApproved = $isApproved;
    }

    public function getAuthor(): User
    {
        return $this->author;
    }

    public function setAuthor(User $author): void
    {
        $this->author = $author;
    }

    public function getVoiture(): Voiture
    {
        return $this->voiture;
    }

    public function setVoiture(Voiture $voiture): void
    {
        $this->voiture = $voiture;
    }

    public function getCreated(): DateTimeImmutable
    {
        return $this->created;
    }
}
