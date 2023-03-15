<?php

namespace App\Entity;

use Assert\NotBlank;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UrlRepository;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UrlRepository::class)]
#[ORM\Table(name: 'Urls')]

class Url
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, unique: true)]
    #[Assert\NotBlank(message: 'You nees to enter an URL')]
    #[Assert\Url(message: 'The Url entered is invalid.')]
    private ?string $original = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $shortened = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOriginal(): ?string
    {
        return $this->original;
    }

    public function setOriginal(string $original): self
    {
        $this->original = $original;

        return $this;
    }

    public function getShortened(): ?string
    {
        return $this->shortened;
    }

    public function setShortened(string $shortened): self
    {
        $this->shortened = $shortened;

        return $this;
    }
}
