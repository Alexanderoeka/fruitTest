<?php


namespace App\Dto;


use App\Common\BaseDto;
use Symfony\Component\HttpFoundation\RequestStack;

class FruitDto extends BaseDto
{
    public ?int $id;
    public ?string $name;
    public ?string $genus;
    public ?string $family;
    public ?string $fruitOrder;
    public ?string $nutritionId;

    public function __construct(RequestStack|array $request)
    {
        parent::__construct($request);

        $this->id = $this->getValue('id');
        $this->name = $this->getValue('name');
        $this->genus = $this->getValue('genus');
        $this->family = $this->getValue('family');
        $this->fruitOrder = $this->getValue('order');
        $this->nutritionId = $this->getValue('nutritionId');
    }


}