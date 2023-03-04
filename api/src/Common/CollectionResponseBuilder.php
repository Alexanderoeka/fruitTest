<?php


namespace App\Common;


use League\Fractal\Pagination\PagerfantaPaginatorAdapter;
use League\Fractal\Resource\Collection;
use Pagerfanta\Adapter\AdapterInterface;
use Pagerfanta\Pagerfanta;

class CollectionResponseBuilder
{


//    /**
//     * @param \League\Fractal\TransformerAbstract|string $transformer
//     */
//    protected function generateCollection(AdapterInterface $doctrineAdapter, SearchDto $dto, $transformer): Collection
//    {
//        $paginator = new Pagerfanta($doctrineAdapter);
//        $paginator->setCurrentPage($dto->page);
//        $paginator->setMaxPerPage($dto->perPage);
//
//        $filteredResults = $paginator->getCurrentPageResults();
//        $resource = new Collection($filteredResults, $transformer);
//        $resource->setPaginator(new PagerfantaPaginatorAdapter($paginator, function (int $page) use ($dto) {
//            $newParams = $dto->getRouteParams();
//            $newParams['page'] = $page;
//
//            return $this->router->generate($dto->getRoute(), $newParams, 0);
//        }));
//
//        return $resource;
//    }


}