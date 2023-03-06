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


    #[Route('/search-fruits', methods: ['POST'])]
    public function searchFruits(SearchDto $dto): JsonResponse
    {
//                $d = 12/0;
        return $this->fruitService->searchFruits($dto);
    }


    #[Route('/update-fruit', methods: ['POST'])]
    public function updateFruit(FruitDto $dto): JsonResponse
    {
        return $this->fruitService->updateFruit($dto);
    }

    #[Route('/search-favorite-fruits', methods: ['POST'])]
    public function searchFavoriteFruits(SearchDto $dto): JsonResponse
    {
        return $this->fruitService->searchFavoriteFruits($dto);

    }

}