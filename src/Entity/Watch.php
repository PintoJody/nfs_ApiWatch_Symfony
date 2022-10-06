<?php

namespace App\Entity;

use App\Repository\WatchRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: WatchRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Watch
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @Assert\NotBlank(message="This field must not be empty")
     */
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @Assert\NotBlank(message="This field must not be empty")
     */
    #[ORM\Column(length: 255)]
    private ?string $shortDescription = null;

    /**
     * @Assert\NotBlank(message="This field must not be empty")
     */
    #[ORM\Column(type: Types::TEXT)]
    private ?string $Description = null;

    /**
     * @Assert\NotBlank(message="This field must not be empty")
     */
    #[ORM\Column]
    private ?float $price = null;


    #[ORM\Column(nullable: true)]
    private ?int $note = null;

    /**
     * @Assert\NotBlank(message="This field must not be empty")
     */
    #[ORM\Column(length: 255)]
    private ?string $color = null;

    /**
     * @Assert\NotBlank(message="This field must not be empty")
     */
    #[ORM\Column]
    private ?bool $gps = null;


    #[ORM\Column]
    private ?int $size = null;

    /**
     * @Assert\NotBlank(message="This field must not be empty")
     */
    #[ORM\Column]
    private ?bool $bluetooth = null;

    #[ORM\Column]
    private ?int $weight = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $picture = null;

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

    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    public function setShortDescription(string $shortDescription): self
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(?int $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function isGps(): ?bool
    {
        return $this->gps;
    }

    public function setGps(bool $gps): self
    {
        $this->gps = $gps;

        return $this;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(int $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function isBluetooth(): ?bool
    {
        return $this->bluetooth;
    }

    public function setBluetooth(bool $bluetooth): self
    {
        $this->bluetooth = $bluetooth;

        return $this;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(int $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    #[ORM\PrePersist]
    public function setCreatedAt(): self
    {
        $this->createdAt = new \DateTimeImmutable();

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }
}
