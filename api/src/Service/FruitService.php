<?php


namespace App\Service;


use App\Common\SearchDto;
use App\Dto\FruitDto;
use App\Dto\NutritionDto;
use App\Entity\Fruit;
use App\Entity\Nutrition;
use App\Repository\FruitRepository;
use App\Repository\NutritionRepository;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class FruitService
{
    private HttpClientInterface $httpClient;

    private FruitRepository $fruitRepository;
    private NutritionRepository $nutritionRepository;

    public function __construct(HttpClientInterface $httpClient,
                                FruitRepository $fruitRepository,
                                NutritionRepository $nutritionRepository
    )
    {
        $this->httpClient = $httpClient;
        $this->fruitRepository = $fruitRepository;
        $this->nutritionRepository = $nutritionRepository;
    }


    public function searchFruits(SearchDto $dto)
    {
        $offset = ($dto->page - 1) * $dto->perPage;
        $result = $this->fruitRepository->getFruitsWithPaging($dto->search, $dto->order, $dto->orderBy, $offset, $dto->perPage);
        return $result;

    }

    public function searchFavoriteFruits()
    {

    }

    public function setFavoriteFruit($id)
    {

    }

    public function unsetFavoriteFruit($id)
    {

    }


    public function getFruitsFromSite(): array
    {
        $response = $this->httpClient->request(
            'GET',
            'https://fruityvice.com/api/fruit/all'
        );

        $fruitsArray = $response->toArray();

        $this->createFruits($fruitsArray);


        return $fruitsArray;
    }


    public function createFruits(array $fruitsArray): void
    {
        $fruits = [];
        foreach ($fruitsArray as $fruit) {

            $isFruitBefore = $this->fruitRepository->findOneBy(['name' => $fruit['name']]);
            if ($isFruitBefore)
                continue;

            $nutrition = $this->createNutrition(new NutritionDto($fruit['nutritions']));
            $fruits [] = $this->createFruit(new FruitDto($fruit), $nutrition);
        }
        $this->nutritionRepository->flush();
    }


    public function createFruit(FruitDto $dto, Nutrition $nutrition): Fruit
    {


        $fruit = new Fruit;

        $fruit->setName($dto->name);
        $fruit->setFamily($dto->family);
        $fruit->setGenus($dto->genus);
        $fruit->setFruitOrder($dto->fruitOrder);
        $fruit->setNutrition($nutrition);

        $this->fruitRepository->save($fruit);

        return $fruit;
    }


    public function createNutrition(NutritionDto $dto): Nutrition
    {
        $nutrition = new Nutrition;

        $nutrition->setCarbohydrates($dto->carbohydrates);
        $nutrition->setProtein($dto->protein);
        $nutrition->setFat($dto->fat);
        $nutrition->setCalories($dto->calories);
        $nutrition->setSugar($dto->sugar);

        $this->nutritionRepository->save($nutrition);
        return $nutrition;
    }


}