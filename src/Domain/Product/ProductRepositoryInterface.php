<?php

declare(strict_types=1);

namespace App\Domain\Product;

interface ProductRepositoryInterface
{
    public function add(Product $product): void;

    public function get(ProductId $id): Product;
}
