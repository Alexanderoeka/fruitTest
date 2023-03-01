<?php


namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/fruit')]
class FruitController
{


    #[Route('/show', name: 'show', methods: ['GET'])]
    public function showFruit(): JsonResponse
    {
        $test = 1;
        return new JsonResponse(['haha' => 'sereger']);
    }


}