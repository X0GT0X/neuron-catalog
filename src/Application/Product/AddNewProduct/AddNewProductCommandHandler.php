<?php

declare(strict_types=1);

namespace App\Application\Product\AddNewProduct;

use App\Application\Configuration\Command\CommandHandlerInterface;
use App\Domain\Money\Currency;
use App\Domain\Money\Money;
use App\Domain\Product\Product;
use App\Domain\Product\ProductRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Uid\Uuid;

#[AsMessageHandler]
final readonly class AddNewProductCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private ProductRepositoryInterface $productRepository
    ) {
    }

    public function __invoke(AddNewProductCommand $command): Uuid
    {
        $product = Product::addNew(
            $command->name,
            $command->description,
            $command->sku,
            Money::from($command->priceAmount, Currency::from($command->priceCurrency))
        );

        $this->productRepository->add($product);

        return $product->id->getValue();
    }
}
