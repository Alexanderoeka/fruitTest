<?php


namespace App\Common;


class CollectionTransformer
{
    public static function getData(array $data, $transformer): array
    {
        $resultData = [];
        foreach ($data as $one) {
            $resultData[] = $transformer->transform($one);
        }
        return $resultData;
    }
}