<?php


namespace App\Transformer;


use App\Entity\Nutrition;

class NutritionTransformer
{
    public static function transform(Nutrition $nutrition)
    {
        return [
            'id' => $nutrition->getId(),
            'carbohydrates' => $nutrition->getCarbohydrates(),
            'protein' => $nutrition->getProtein(),
            'fat' => $nutrition->getFat(),
            'calories' => $nutrition->getCalories(),
            'sugar' => $nutrition->getSugar(),
        ];
    }

}