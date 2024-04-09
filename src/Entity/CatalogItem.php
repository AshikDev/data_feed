<?php

namespace App\Entity;

use App\Repository\CatalogItemRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CatalogItemRepository::class)]
class CatalogItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $entity_id = null;

    #[ORM\Column(length: 255)]
    private ?string $category_name = null;

    #[ORM\Column(length: 80)]
    private ?string $sku = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $short_desc = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $price = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $link = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $brand = null;

    #[ORM\Column]
    private ?int $rating = null;

    #[ORM\Column(length: 80, nullable: true)]
    private ?string $caffeine_type = null;

    #[ORM\Column(nullable: true)]
    private ?int $count = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $flavored = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $seasonal = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $in_stock = null;

    #[ORM\Column(nullable: true)]
    private ?bool $facebook = null;

    #[ORM\Column(nullable: true)]
    private ?bool $is_k_cup = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEntityId(): ?int
    {
        return $this->entity_id;
    }

    public function setEntityId(int $entity_id): static
    {
        $this->entity_id = $entity_id;

        return $this;
    }

    public function getCategoryName(): ?string
    {
        return $this->category_name;
    }

    public function setCategoryName(string $category_name): static
    {
        $this->category_name = $category_name;

        return $this;
    }

    public function getSku(): ?string
    {
        return $this->sku;
    }

    public function setSku(string $sku): static
    {
        $this->sku = $sku;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
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

    public function getShortDesc(): ?string
    {
        return $this->short_desc;
    }

    public function setShortDesc(?string $short_desc): static
    {
        $this->short_desc = $short_desc;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): static
    {
        $this->link = $link;

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

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(?string $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(int $rating): static
    {
        $this->rating = $rating;

        return $this;
    }

    public function getCaffeineType(): ?string
    {
        return $this->caffeine_type;
    }

    public function setCaffeineType(?string $caffeine_type): static
    {
        $this->caffeine_type = $caffeine_type;

        return $this;
    }

    public function getCount(): ?int
    {
        return $this->count;
    }

    public function setCount(?int $count): static
    {
        $this->count = $count;

        return $this;
    }

    public function getFlavored(): ?string
    {
        return $this->flavored;
    }

    public function setFlavored(?string $flavored): static
    {
        $this->flavored = $flavored;

        return $this;
    }

    public function getSeasonal(): ?string
    {
        return $this->seasonal;
    }

    public function setSeasonal(?string $seasonal): static
    {
        $this->seasonal = $seasonal;

        return $this;
    }

    public function getInStock(): ?string
    {
        return $this->in_stock;
    }

    public function setInStock(?string $in_stock): static
    {
        $this->in_stock = $in_stock;

        return $this;
    }

    public function getFacebook(): ?bool
    {
        return $this->facebook;
    }

    public function setFacebook(?bool $facebook): static
    {
        $this->facebook = $facebook;

        return $this;
    }

    public function isIsKCup(): ?bool
    {
        return $this->is_k_cup;
    }

    public function setIsKCup(?bool $is_k_cup): static
    {
        $this->is_k_cup = $is_k_cup;

        return $this;
    }
}
