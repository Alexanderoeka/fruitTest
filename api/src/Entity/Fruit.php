<?php


namespace App\Entity;

use App\Repository\FruitRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToOne;


#[Entity(repositoryClass: FruitRepository::class)]
class Fruit
{
    #[Id, Column(name: 'id', type: Types::INTEGER), GeneratedValue()]
    private int $id;

    #[Column(type: Types::STRING, length: 255)]
    private string $name;

    #[Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $genus;

    #[Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $family;

    #[Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $fruitOrder;

    #[OneToOne(targetEntity: Nutrition::class)]
    private Nutrition $nutrition;

    #[Column(type: Types::BOOLEAN, length: 255, options: ["default" => false])]
    private bool $favorite;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getGenus(): ?string
    {
        return $this->genus;
    }

    public function setGenus(?string $genus): void
    {
        $this->genus = $genus;
    }

    public function getFruitOrder(): ?string
    {
        return $this->fruitOrder;
    }

    public function setFruitOrder(?string $fruitOrder): void
    {
        $this->fruitOrder = $fruitOrder;
    }

    public function getFamily(): ?string
    {
        return $this->family;
    }

    public function setFamily(?string $family): void
    {
        $this->family = $family;
    }

    public function getNutrition(): Nutrition
    {
        return $this->nutrition;
    }

    public function setNutrition(Nutrition $nutrition): void
    {
        $this->nutrition = $nutrition;
    }

    public function isFavorite(): bool
    {
        return $this->favorite;
    }

    public function setFavorite(bool $favorite): void
    {
        $this->favorite = $favorite;
    }


}