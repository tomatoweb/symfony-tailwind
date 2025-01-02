<?php

namespace App\Entity;

use App\Repository\ProfileRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProfileRepository::class)]
class Profile
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;   

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $age = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $plz = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $height = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $weight = null;    

    #[ORM\Column(nullable: true)]
    private ?int $image = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $hidden = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $country = null;

    #[ORM\Column(length: 255)]
    private ?string $gender = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $orientation = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createtime = null;

    #[ORM\ManyToOne(inversedBy: 'profiles')]
    private ?Pool $pool = null;

    public function __construct()
    {
        $this->createtime = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }    

    public function getProfileID(): ?int
    {
        return $this->id;
    }

    public function setProfileID(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): static
    {
        $this->age = $age;

        return $this;
    }

    public function getPlz(): ?string
    {
        return $this->plz;
    }

    public function setPlz(?string $plz): static
    {
        $this->plz = $plz;

        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(?int $height): static
    {
        $this->height = $height;

        return $this;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(?int $weight): static
    {
        $this->weight = $weight;

        return $this;
    }

    public function getImage(): ?int
    {
        return $this->image;
    }

    public function setImage(?int $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getHidden(): ?int
    {
        return $this->hidden;
    }

    public function setHidden(?int $hidden): static
    {
        $this->hidden = $hidden;

        return $this;
    }

    public function getCountry(): ?int
    {
        return $this->country;
    }

    public function setCountry(?int $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getPool(): ?Pool
    {
        return $this->pool;
    }

    public function setPool(?Pool $pool): static
    {
        $this->pool = $pool;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): static
    {
        $this->gender = $gender;

        return $this;
    }

    public function getOrientation(): ?string
    {
        return $this->orientation;
    }

    public function setOrientation(?string $orientation): static
    {
        $this->orientation = $orientation;

        return $this;
    }

    public function getCreatetime(): ?\DateTimeImmutable
    {
        return $this->createtime;
    }

    public function setCreatetime(\DateTimeImmutable $createtime): static
    {
        $this->createtime = $createtime;

        return $this;
    }
}
