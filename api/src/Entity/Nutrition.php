<?php


namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use App\Repository\NutritionRepository;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;

#[Entity(repositoryClass:NutritionRepository::class)]
class Nutrition
{

    #[Id]
    #[GeneratedValue]
    #[Column(type:Types::INTEGER)]
    private int $id;

    #[Column(type: Types::FLOAT)]
    private float $carbohydrates;

    #[Column(type: Types::FLOAT)]
    private float $protein;

    #[Column(type: Types::FLOAT)]
    private float $fat;

    #[Column(type: Types::FLOAT)]
    private float $calories;

    #[Column(type: Types::FLOAT)]
    private float $sugar;

    public function getId(): int
    {
        return $this->id;
    }

    public function getCarbohydrates(): float
    {
        return $this->carbohydrates;
    }

    public function setCarbohydrates(float $carbohydrates): void
    {
        $this->carbohydrates = $carbohydrates;
    }

    public function getProtein(): float
    {
        return $this->protein;
    }


    public function setProtein(float $protein): Nutrition
    {
        $this->protein = $protein;
        return $this;
    }

    public function getFat(): float
    {
        return $this->fat;
    }

    public function setFat(float $fat): void
    {
        $this->fat = $fat;
    }

    public function getCalories(): float
    {
        return $this->calories;
    }

    public function setCalories(float $calories): void
    {
        $this->calories = $calories;
    }

    public function getSugar(): float
    {
        return $this->sugar;
    }

    public function setSugar(float $sugar): void
    {
        $this->sugar = $sugar;
    }



}