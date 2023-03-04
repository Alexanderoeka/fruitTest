<?php


namespace App\Transformer;


use App\Entity\Fruit;

class FruitTransformer
{
    public static function transform(Fruit $fruit)
    {
        return [
            'id' => $fruit->getId(),
            'name' => $fruit->getName(),
            'genus' => $fruit->getGenus(),
            'family'=>$fruit->getFamily(),
            'fruitOrder'=>$fruit->getFruitOrder(),
            'favorite'=>$fruit->isFavorite()
        ];
    }

}