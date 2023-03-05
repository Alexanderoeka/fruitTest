<?php


namespace App\Service;


use App\Common\CollectionTransformer;
use App\Common\SearchDto;
use App\Dto\FruitDto;
use App\Dto\NutritionDto;
use App\Entity\Fruit;
use App\Entity\Nutrition;
use App\Repository\FruitRepository;
use App\Repository\NutritionRepository;
use App\Transformer\FruitTransformer;
use PhpParser\Node\Expr\Throw_;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Exception;

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
        $count = $this->fruitRepository->countRows($dto->search);
        $pages = ceil($count / $dto->perPage);
//        if()
        $offset = ($dto->page - 1) * $dto->perPage;
        $result = $this->fruitRepository->getFruitsWithPaging($dto->search, $dto->order, $dto->orderBy, $offset, $dto->perPage);


        $pagination = [
            'page' => $dto->page,
            'perPage' => $dto->perPage,
            'order' => $dto->order,
            'orderBy' => $dto->orderBy,
            'pages' => $pages,
            'rows' => $count
        ];

        $data = CollectionTransformer::getData($result, new FruitTransformer());

        return new JsonResponse(['data' => $data, 'success' => true, 'pagination' => $pagination]);
    }

    public function searchFavoriteFruits(SearchDto $dto)
    {
        $count = $this->fruitRepository->countRows($dto->search, true);
        $pages = ceil($count / $dto->perPage);
        $offset = ($dto->page - 1) * $dto->perPage;
        $result = $this->fruitRepository->getFavoriteFruitsWithPaging($dto->search, $dto->order, $dto->orderBy, $offset, $dto->perPage);


        $pagination = [
            'page' => $dto->page,
            'perPage' => $dto->perPage,
            'order' => $dto->order,
            'orderBy' => $dto->orderBy,
            'pages' => $pages,
            'rows' => $count
        ];

        $data = CollectionTransformer::getData($result, new FruitTransformer());

        return new JsonResponse(['data' => $data, 'success' => true, 'pagination' => $pagination]);
    }


    public function setFavoriteFruit($id)
    {

    }

    public function unsetFavoriteFruit($id)
    {

    }

    public function updateFruit(FruitDto $dto)
    {
        $fruit = $this->fruitRepository->find($dto->id);
        if (!$fruit)
            throw new Exception("This fruit with id : $dto->id doesnt exists");

        $fruit->setFavorite($dto->favorite);

        $this->fruitRepository->save($fruit, true);
        return new JsonResponse(['success'=>true]);
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