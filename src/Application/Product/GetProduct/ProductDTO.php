<?php

declare(strict_types=1);

namespace App\Application\Product\GetProduct;

final readonly class ProductDTO
{
    public function __construct(
        public string $id,
        public string $name,
        public string $description,
        public string $sku,
        public PriceDTO $price,
    ) {
    }
}

final readonly class PriceDTO
{
    public function __construct(
        public int $amount,
        public string $currency,
    ) {
    }
}
