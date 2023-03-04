<?php


namespace App\Dto;


use App\Common\BaseDto;
use Symfony\Component\HttpFoundation\RequestStack;

class NutritionDto extends BaseDto
{
    public ?int $id;
    public ?float $carbohydrates;
    public ?float $protein;
    public ?float $fat;
    public ?float $calories;
    public ?float $sugar;

    public function __construct(RequestStack|array $request)
    {
        parent::__construct($request);

        $this->id = $this->getValue('id');
        $this->carbohydrates = $this->getValue('carbohydrates');
        $this->protein = $this->getValue('protein');
        $this->fat = $this->getValue('fat');
        $this->calories = $this->getValue('calories');
        $this->sugar = $this->getValue('sugar');
    }

}