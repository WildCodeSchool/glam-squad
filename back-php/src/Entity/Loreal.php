<?php

namespace App\Entity;

use App\Repository\LorealRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LorealRepository::class)]
class Loreal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $brand = null;

    #[ORM\Column(length: 255)]
    private ?string $category = null;

    #[ORM\Column(length: 255)]
    private ?string $nameProduct = null;

    #[ORM\Column(length: 255)]
    private ?string $dataAchat = null;

    #[ORM\Column(length: 255)]
    private ?string $contenanceTotale = null;

    #[ORM\Column(length: 255)]
    private ?string $uniteProduct = null;

    #[ORM\Column(length: 255)]
    private ?string $frequenceJ = null;

    #[ORM\Column(length: 255)]
    private ?string $dureeTotal = null;

    #[ORM\Column(length: 255)]
    private ?string $dureeProduct = null;

    #[ORM\Column(length: 255)]
    private ?string $dateFinProduct = null;

    #[ORM\Column(length: 255)]
    private ?string $dateFinString = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $imgUrl = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $websiteUrl = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $slug = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getNameProduct(): ?string
    {
        return $this->nameProduct;
    }

    public function setNameProduct(string $nameProduct): static
    {
        $this->nameProduct = $nameProduct;

        return $this;
    }

    public function getDataAchat(): ?string
    {
        return $this->dataAchat;
    }

    public function setDataAchat(string $dataAchat): static
    {
        $this->dataAchat = $dataAchat;

        return $this;
    }

    public function getContenanceTotale(): ?string
    {
        return $this->contenanceTotale;
    }

    public function setContenanceTotale(string $contenanceTotale): static
    {
        $this->contenanceTotale = $contenanceTotale;

        return $this;
    }

    public function getUniteProduct(): ?string
    {
        return $this->uniteProduct;
    }

    public function setUniteProduct(string $uniteProduct): static
    {
        $this->uniteProduct = $uniteProduct;

        return $this;
    }

    public function getFrequenceJ(): ?string
    {
        return $this->frequenceJ;
    }

    public function setFrequenceJ(string $frequenceJ): static
    {
        $this->frequenceJ = $frequenceJ;

        return $this;
    }

    public function getDureeTotal(): ?string
    {
        return $this->dureeTotal;
    }

    public function setDureeTotal(string $dureeTotal): static
    {
        $this->dureeTotal = $dureeTotal;

        return $this;
    }

    public function getDureeProduct(): ?string
    {
        return $this->dureeProduct;
    }

    public function setDureeProduct(string $dureeProduct): static
    {
        $this->dureeProduct = $dureeProduct;

        return $this;
    }

    public function getDateFinProduct(): ?string
    {
        return $this->dateFinProduct;
    }

    public function setDateFinProduct(string $dateFinProduct): static
    {
        $this->dateFinProduct = $dateFinProduct;

        return $this;
    }

    public function getDateFinString(): ?string
    {
        return $this->dateFinString;
    }

    public function setDateFinString(string $dateFinString): static
    {
        $this->dateFinString = $dateFinString;

        return $this;
    }

    public function getImgUrl(): ?string
    {
        return $this->imgUrl;
    }

    public function setImgUrl(string $imgUrl): static
    {
        $this->imgUrl = $imgUrl;

        return $this;
    }

    public function getWebsiteUrl(): ?string
    {
        return $this->websiteUrl;
    }

    public function setWebsiteUrl(string $websiteUrl): static
    {
        $this->websiteUrl = $websiteUrl;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }
}
