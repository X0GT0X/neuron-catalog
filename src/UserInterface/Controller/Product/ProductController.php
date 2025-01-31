<?php

declare(strict_types=1);

namespace App\UserInterface\Controller\Product;

use App\Application\Contract\CatalogModuleInterface;
use App\Application\Product\AddNewProduct\AddNewProductCommand;
use App\Application\Product\GetProduct\GetProductQuery;
use App\UserInterface\Controller\Product\Request\AddNewProductRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Uid\Uuid;

final readonly class ProductController
{
    public function __construct(
        private CatalogModuleInterface $catalogModule
    ) {
    }

    #[Route('products', methods: ['POST'])]
    public function addNew(AddNewProductRequest $request): JsonResponse
    {
        $productId = $this->catalogModule->executeCommand(new AddNewProductCommand(
            $request->name,
            $request->description,
            $request->sku,
            $request->priceAmount,
            $request->priceCurrency,
        ));

        return new JsonResponse([
            'id' => $productId,
        ]);
    }

    #[Route('products/{productId}', methods: ['GET'])]
    public function getById(Uuid $productId): JsonResponse
    {
        $product = $this->catalogModule->executeQuery(new GetProductQuery($productId));

        return new JsonResponse($product, null === $product ? Response::HTTP_NOT_FOUND : Response::HTTP_OK);
    }
}
