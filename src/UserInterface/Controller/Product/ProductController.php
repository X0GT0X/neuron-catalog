<?php

declare(strict_types=1);

namespace App\UserInterface\Controller\Product;

use App\Application\Contract\CatalogModuleInterface;
use App\Application\Product\AddNewProduct\AddNewProductCommand;
use App\UserInterface\Controller\Product\Request\AddNewProductRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

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
}
