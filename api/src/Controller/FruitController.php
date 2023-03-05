<?php


namespace App\Controller;

use App\Common\CollectionTransformer;
use App\Common\SearchDto;
use App\Dto\FruitDto;
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
//                $d = 12/0;
        return $this->fruitService->searchFruits($dto);
    }

    #[Route('/bob', name: 'fruits.get', methods: ['GET'])]
    public function hui(SearchDto $dto): JsonResponse
    {
        return new JsonResponse(['qfe' => 'ewfwe']);
//        return new JsonResponse(FruitTransformer::transform($this->fruitService->searchFruits($dto)));
    }


    #[Route('/update-fruit', methods: ['POST'])]
    public function updateFruit(FruitDto $dto): JsonResponse
    {
        return $this->fruitService->updateFruit($dto);
    }

    #[Route('/search-favorite-fruits', methods: ['POST'])]
    public function searchFavoriteFruits(SearchDto $dto)
    {
        return $this->fruitService->searchFavoriteFruits($dto);

    }

}