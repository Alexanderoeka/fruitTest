<?php


namespace App\Controller;

use App\Common\CollectionTransformer;
use App\Common\SearchDto;
use App\Service\FruitService;
use App\Transformer\FruitTransformer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/fruit')]
class FruitController extends BaseController
{
    private FruitService $fruitService;

    public function __construct(FruitService $fruitService)
    {
        $this->fruitService = $fruitService;
    }


    #[Route('/show', name: 'show', methods: ['GET'])]
    public function showFruit(): JsonResponse
    {
        $test = 1;
        return new JsonResponse(['haha' => 'sereger']);
    }

    #[Route('/bobil', name: 'bobil', methods: ['POST'])]
    public function searchFruits(SearchDto $dto): JsonResponse
    {
//        $d = 12/0;
        $result = $this->fruitService->searchFruits($dto);
        $data = CollectionTransformer::getData($result, new FruitTransformer());

        return new JsonResponse(['data' => $data]);

    }

    #[Route('/bob', name: 'fruits.get', methods: ['GET'])]
    public function hui(SearchDto $dto): JsonResponse
    {
        return new JsonResponse(['qfe' => 'ewfwe']);
//        return new JsonResponse(FruitTransformer::transform($this->fruitService->searchFruits($dto)));
    }


    #[Route('/search-favorite-fruits', name: 'favorite-fruits.get', methods: ['GET'])]
    public function searchFavoriteFruits()
    {

    }

    #[Route('/set-favorite-fruit/{id}', name: 'favorite-fruits.get', methods: ['GET'])]
    public function setFavoriteFruit($id)
    {

    }

    #[Route('/unset-favorite-fruit/{id}', name: 'favorite-fruits.get', methods: ['GET'])]
    public function unsetFavoriteFruit($id)
    {

    }


}